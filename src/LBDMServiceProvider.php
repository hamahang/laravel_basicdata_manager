<?php

namespace Hamahang\LBDM;
use Illuminate\Support\ServiceProvider;
use Validator;

class LBDMServiceProvider extends ServiceProvider
{
    public function boot()
    {
    	// the main router
        $this->loadRoutesFrom( __DIR__.'/Routes/backend_routes.php');
	    // the main views folder
	    $this->loadViewsFrom(__DIR__ . '/Views', 'laravel_basicdata_manager');
	    // the main migration folder for create sms_ir tables

	    // for publish the views into main app
	    $this->publishes([
		    __DIR__ . '/Views' => resource_path('views/vendor/laravel_basicdata_manager'),
	    ]);

	    $this->publishes([
		    __DIR__ . '/Migrations/' => database_path('migrations')
	    ], 'migrations');

	    // for publish the assets files into main app
	    $this->publishes([
		    __DIR__.'/assets' => public_path('vendor/laravel_basicdata_manager'),
	    ], 'public');

	    // for publish the sms_ir config file to the main app config folder
	    $this->publishes([
		    __DIR__ . '/Config/LBDM.php' => config_path('laravel_basicdata_manager.php'),
	    ]);

        Validator::extend('exists_or_zero', function ($attribute, $value, $parameters) {
           /* dd($attribute, $value, $parameters);*/
            if($value==0 || !$value) return true;
            else
            {
             $basic_data=\Hamahang\LBDM\Models\Basicdata::find($value);
             if($basic_data) return true;
             else return false;
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    	// set the main config file
	    $this->mergeConfigFrom(
		    __DIR__ . '/Config/LBDM.php', 'laravel_basicdata_manager'
	    );

		// bind the LFMC Facade
	    $this->app->bind('LBDMC', function () {
		    return new LBDMC;
	    });
    }
}
