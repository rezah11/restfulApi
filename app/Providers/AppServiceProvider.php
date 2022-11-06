<?php

namespace App\Providers;

use App\Http\Resources\UserResource;
//use App\Http\Resources\UserResource11;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        UserResource::wrap('testi');
        Passport::tokensExpireIn(now()->addDay(1));
        Passport::tokensExpireIn(now()->addDay(30));
    }
}
