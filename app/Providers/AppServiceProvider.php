<?php

namespace App\Providers;

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
     * @return void
     */
    public function boot()
    {
//        \Validator::extend('integer_keys', function($attribute, $value, $parameters, $validator) {
//            return is_array($value) && count(array_filter(array_keys($value), 'is_string')) === 0;
//        });
    }
}
