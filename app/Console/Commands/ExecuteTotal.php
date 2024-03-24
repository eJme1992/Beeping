<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use App\Models\Repository\Executed\IExecutedRepository;
use App\Models\Repository\Order\IOrderRepository;
use Illuminate\Contracts\Bus\Dispatcher;

class ExecuteTotal extends Command
{
    protected $dispatcher;
    protected $orderRepository;
    protected $executedRepository;

    public function __construct(
        Dispatcher $dispatcher,
        IOrderRepository $orderRepository,
        IExecutedRepository $executedRepository
    ) {
        parent::__construct();
        $this->dispatcher = $dispatcher;
        $this->orderRepository = $orderRepository;
        $this->executedRepository = $executedRepository;
    }

    protected $signature = 'execute:total';
    protected $description = 'Calculate total cost of all orders and save to executed table';

    public function handle()
    {
        // Get the current process state from Redis
        $offset = Redis::get('process:query:offset') ?: 0;
        $totalCost = Redis::get('process:query:total_cost') ?: 0;
        $ordersCount = Redis::get('process:query:orders_count') ?: 0;
        $limit = 36;
        // Query the records
        $orders = $this->orderRepository->getOrderforPage($offset, $limit);
         
        if ($orders->isEmpty()) {
            $this->info('All orders have been processed.');
            return;
        }
        // Calculate the total cost of all orders
        foreach ($orders as $order) {
            foreach ($order->orderLines as $orderLine) {
                $totalCost += $orderLine->qty * $orderLine->product->cost;
            }
        }
        // Increment the total count of orders
        $ordersCount += $orders->count();
        // Persist the total cost and orders count in Redis
        Redis::set('process:query:orders_count', $ordersCount);
        Redis::set('process:query:total_cost', $totalCost);
        $this->info('Total cost: ' . $totalCost);
        // Enqueue the job to save the result to the executed table
        $this->dispatcher->dispatch(function () use ($totalCost, $ordersCount) {
            // Save the result to the executed table using the endpoint
            $response = Http::post(route('api.executed.create'), [
                'total_cost' => $totalCost,
                'total_orders' => $ordersCount
            ]);
            // Check if the request was successful
            if ($response->successful()) {
                $this->info('Total cost calculated and saved successfully.');
            } else {
                $this->error('Failed to save total cost.');
            }
        });
        // Increment the offset for next time
        $offset += $limit;
        // Persist the new offset in Redis
        Redis::set('process:query:offset', $offset);
        $this->info('Next offset: ' . $offset);
    }
}
