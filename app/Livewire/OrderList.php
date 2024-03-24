<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Repository\Executed\IExecutedRepository;
use App\Models\Repository\Order\IOrderRepository;
use Illuminate\Support\Facades\Redis;
use Livewire\WithPagination;


class OrderList extends Component
{
    use WithPagination;

    private $orderRepository;
    private $executedRepository;

    public $totalOrders;
    public $totalCost;
    public $lastExecuted;

  

    private function getOrders()
    {
        return $this->orderRepository->paginate(10);
    }

    private function getTotalOrders()
    {
        return $this->orderRepository->all()->count();
    }

    private function getTotalCost()
    {
        $totalCost = Redis::get('total_cost');
        if ($totalCost) {
            return $totalCost;
        }
        return 0;
        //return $this->orderRepository->all()->sum('total_cost');
    }

    public function mount(IOrderRepository $orderRepository, IExecutedRepository $executedRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->executedRepository = $executedRepository;
        // Calcular el total de pedidos y el costo total
        $this->totalOrders =  $this->getTotalOrders();
        $this->totalCost   =  $this->getTotalCost();
        // Obtener el último registro de la tabla 'executed'
        $this->lastExecuted =  $this->executedRepository->getLastExecuted();
    }

    public function render(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
        // Obtener todos los pedidos y paginarlos
        $orders = $this->orderRepository->paginate(10); // 10 es el número de elementos por página
        return view('livewire.order-list', ['orders' =>  $orders]);
    }

}
