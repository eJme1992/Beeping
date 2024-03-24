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

    protected $orderRepository;
    protected $executedRepository;
    protected $dispacher;

    public function __construct(Dispatcher $dispacher,IOrderRepository $orderLineRepository,IExecutedRepository $executedRepository )
    {
        parent::__construct();
        $this->dispacher = $dispacher;
        $this->orderRepository = $orderLineRepository;
        $this->executedRepository = $executedRepository;
      
    }

    protected $signature = 'execute:total';
    protected $description = 'Calculate total cost of all orders and save to executed table';

    public function handle()
    {
        // Obtener todos los pedidos
        $orders =  $this->orderRepository->all();
        // Calcular el costo total de todos los pedidos
        $totalCost = 0;
        foreach ($orders as $order) {
            foreach ($order->orderLines as $orderLine) {
                $totalCost += $orderLine->qty * $orderLine->product->cost;
            }
        }

        Redis::throttle('execute_total')->allow(10)->every(60)->then(function () use ($totalCost, $orders) {
            // Guardar el resultado en Redis
            Redis::set('total_cost', $totalCost);
        
            // Encolar el trabajo para guardar el resultado en la tabla executed
            $this->dispacher->dispatch(function () use ($totalCost, $orders) {
                // Guardar el resultado en la tabla executed utilizando el endpoint
                $response = Http::post(route('api.executed.create'), [
                    'total_cost' => $totalCost,
                    'total_orders' => count($orders)
                ]);
                // Comprobar si la solicitud fue exitosa
                if ($response->successful()) {
                    $this->info('Total cost calculated and saved successfully.');
                } else {
                    $this->error('Failed to save total cost.');
                }
            });
            // Este código se ejecutará después de que se haya ejecutado el throttle y se haya guardado en Redis
            // Verificar si se guardó correctamente en Redis
            $totalCost = Redis::get('total_cost');
            if ($totalCost !== null) {
                $this->info('Valor de total_cost en Redis: ' . $totalCost);
            } else {
                $this->error('La clave total_cost no se ha encontrado en Redis.');
            }
        }, function () {
            return $this->error('Unable to execute the job at this time. Please try again later.');
        });

    }
}

