<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

use App\Models\Repository\Executed\IExecutedRepository;
use App\Models\Repository\Order\IOrderRepository;

class SaveTotalCost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $orderRepository;
    private $executedRepository;
    private $offset;
    private $limit;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($offset,$limit)
    {
        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(IOrderRepository $orderRepository,
    IExecutedRepository $executedRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->executedRepository = $executedRepository;
        $offset = $this->offset;
        $limit = $this->limit;
       
        $totalCost   = Redis::get('process:query:total_cost') ?: 0;
        $ordersCount = Redis::get('process:query:orders_count') ?: 0;

        $orders = $this->orderRepository->getOrderforPage($offset, $limit);
        if ($orders->isEmpty()) {
            return;
        }
        foreach ($orders as $order) {
            foreach ($order->orderLines as $orderLine) {
                $totalCost += $orderLine->qty * $orderLine->product->cost;
               ;
            }
        }
        // Increment the total count of orders
        $ordersCount += $orders->count();
        Redis::set('process:query:orders_count', $ordersCount);
        Redis::set('process:query:total_cost', $totalCost);
        $response = Http::post(route('api.executed.create'), [
            'total_cost'   =>  $totalCost ,
            'total_orders' => $ordersCount 
        ]);
        if (!$response->successful()) {
            throw new \Exception('Failed to save total cost.');
        }
    }
}