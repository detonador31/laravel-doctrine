<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DoctrineScientistRepository;
use Scientist;
use ScientistRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ScientistRepository::class, function($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new DoctrineScientistRepository(
                $app['em'],
                $app['em']->getClassMetaData(Scientist::class)
            );
        });        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
