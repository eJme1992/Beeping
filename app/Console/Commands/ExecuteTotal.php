<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use App\Models\Repository\Executed\IExecutedRepository;
use App\Models\Repository\Order\IOrderRepository;
use Illuminate\Contracts\Bus\Dispatcher;
use App\Jobs\SaveTotalCost;

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
        $offset      = Redis::get('process:query:offset') ?: 0;
        $limit       = 10;
        // Query the records
        $orders = $this->orderRepository->getOrderforPage($offset, $limit);
        if ($orders->isEmpty()) {
            $this->info('All orders have been processed.');
            return;
        }
        SaveTotalCost::dispatch($orders);
        $offset += $limit;
        Redis::set('process:query:offset', $offset);
        $this->info('Next offset: ' . $offset);
    }
}
