<?php

namespace JDD\Forms;

use App\Facades\JDD;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

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
            [],
            // BPMN
            [realpath(__DIR__ . '/bpmn/FormBuilder.bpmn')]
        );
    }
}
