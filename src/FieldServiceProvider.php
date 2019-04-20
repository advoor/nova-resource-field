<?php

namespace Advoor\NovaViewField;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/nova-view-field.php' => base_path('config/nova-view-field.php'),
        ]);

        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-view-field', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-view-field', __DIR__.'/../dist/css/field.css');
        });
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
