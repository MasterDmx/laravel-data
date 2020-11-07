<?php

namespace MasterDmx\LaravelData;

use Illuminate\Support\ServiceProvider;

class DataServiceProvider extends ServiceProvider
{
    public function boot()
    {
        include 'func.php';
    }

    public function register()
    {
        $this->app->singleton(Data::class, function () {
            return new Data();
        });
    }
}
