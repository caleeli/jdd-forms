<?php

namespace Subcep\Firmas;

use App\Facades\JDD;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    const PluginName = 'subcep/firmas';

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
            ['/modules/' . self::PluginName . '/firmas.umd.js'],
            // Stylesheets
            [],
            // BPMN
            [realpath(__DIR__ . '/bpmn/FirmaHojaRuta.bpmn')]
        );
    }
}
