<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// ############    namespace App\Providers;
use App\Models\Repository\Executed\IExecutedRepository;
use App\Models\Repository\Executed\ExecutedRepository;
use App\Models\Repository\Order\IOrderLineRepository;
use App\Models\Repository\Order\OrderLineRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // ############    Register Repositories
        $this->app->bind(IExecutedRepository::class,ExecutedRepository::class);
		$this->app->bind(IOrderLineRepository::class, OrderLineRepository::class);
    }
}
