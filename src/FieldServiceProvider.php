<?php

namespace Advoor\NovaResourceField;

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
            __DIR__ . '/config/nova-resource-field.php' => base_path('config/nova-resource-field.php'),
        ]);

        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-resource-field', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-resource-field', __DIR__.'/../dist/css/field.css');
        });
    }
}
