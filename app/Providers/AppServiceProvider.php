<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\UserObserver;
use App\User;

use App\Observers\ProductPictureObserver;
use App\ProductPicture;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);

        ProductPicture::observe(ProductPictureObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
