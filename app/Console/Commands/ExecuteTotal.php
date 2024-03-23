<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Repository\Executed\IExecutedRepository;
use App\Models\Repository\Order\IOrderLineRepository;

class ExecuteTotal extends Command
{
    protected $signature = 'execute:total';
    protected $description = 'Calculate total cost of all orders and save it';

    private $executedRepository;
    private $orderLineRepository;

    public function __construct(IOrderLineRepository $orderLineRepository,IExecutedRepository $executedRepository )
    {
        parent::__construct();
        $this->orderLineRepository = $orderLineRepository;
        $this->executedRepository = $executedRepository;
      
    }

    public function handle()
    {
        $totalCost = $this->orderLineRepository->getTotalCost(); 
        $this->executedRepository->create(['total_cost' => $totalCost]);
        $this->info('Total cost calculated and saved successfully!');
    }
}
