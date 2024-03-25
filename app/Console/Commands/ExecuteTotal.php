<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use App\Jobs\SaveTotalCost;

class ExecuteTotal extends Command
{

    protected $signature = 'execute:total';
    protected $description = 'Calculate total cost of all orders and save to executed table';

    public function handle()
    {
        // Get the current process state from Redis
        $offset      = Redis::get('process:query:offset') ?: 0;
        $limit       = 10;
        // Query the records
        SaveTotalCost::dispatch($offset,$limit);
        $offset += $limit;
        Redis::set('process:query:offset', $offset);
        $this->info('Next offset: ' . $offset);
    }
}
