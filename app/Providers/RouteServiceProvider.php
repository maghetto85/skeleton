<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapAdminRoutes();
        $this->mapApiRoutes();
        $this->mapWebRoutes();

        //
        
    }

    protected function mapAdminRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'domain' => 'admin.homestead.app',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/admin.php');
        });

        Route::group([
            'middleware' => 'web',
            'domain' => 'admin.homestead.app',
            'prefix' => 'admin',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/admin.php');
        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {

        $locales = array_merge(\Cache::rememberForever('locales', function() {
            return \App\Locale::pluck('code')->toArray();
        }),['']);

        foreach($locales as $locale) {

            Route::group([
                'middleware' => ['web','locale'],
                'prefix' => $locale,
                'namespace' => $this->namespace,
            ], function ($router) use($locale) {
                require base_path('routes/web.php');
            });
        }

    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
