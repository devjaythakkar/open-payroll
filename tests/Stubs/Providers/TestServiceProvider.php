<?php

namespace JayThakkar\OpenPayroll\Tests\Stubs\Providers;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        \JayThakkar\OpenPayroll\OpenPayroll::routes();
    }

    /**
     * Register any application services.
     */
    public function register()
    {
    }
}
