<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use  Request;

class RepositoriesServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bind(
            'App\Models\IExecutedRepository',
            'App\Models\ExecutedRepository'
        );

        $ref = Request::url();
        
        view()->share('referer', $ref);
	}

}
