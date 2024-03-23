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
            'App\Models\Executed\IExecutedRepository',
            'App\Models\Executed\ExecutedRepository'
        );

        $ref = Request::url();
        
        view()->share('referer', $ref);
	}

}
