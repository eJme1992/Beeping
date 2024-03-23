<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Executed;

class ExecuteTotal extends Command
{
    protected $signature = 'execute:total';
    protected $description = 'Calculate total cost of all orders and save it';

    public function handle()
    {
        $totalCost = DB::table('order_lines')
            ->join('products', 'order_lines.product_id', '=', 'products.id')
            ->sum(DB::raw('qty * product_cost'));

        Executed::create(['total_cost' => $totalCost]);

        $this->info('Total cost calculated and saved successfully!');
    }
}
