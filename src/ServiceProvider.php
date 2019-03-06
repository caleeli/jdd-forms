<?php

namespace JDD\Forms;

use App\Facades\JDD;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use JDD\Forms\Models\Form;

class ServiceProvider extends BaseServiceProvider
{
    const PluginName = 'jdd/forms';

    /**
     * Inicializa el modulo
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../dist' => public_path('modules/' . self::PluginName),
        ], self::PluginName);
        JDD::addModule(
            self::PluginName,
            // Javascripts
            ['/modules/' . self::PluginName . '/jdd-forms.umd.js'],
            // Stylesheets
            ['/modules/' . self::PluginName . '/jdd-forms.css'],
            // BPMN
            [realpath(__DIR__ . '/bpmn/FormBuilder.bpmn')],
            // Models
            [Form::class]
        );
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }
}
