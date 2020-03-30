<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
     * @param \Illuminate\Routing\UrlGenerator $url
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (App::environment('production') && !request()->is('api*') && !request()->isSecure()) {
            $url->forceScheme('https');
        }
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
    }
}
