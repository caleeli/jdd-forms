<?php

namespace Subcep\Firmas;

use App\Facades\JDD;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Inicializa el modulo
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../dist' => public_path('modules/firmas'),
            ], 'subcep-firmas');
        JDD::addModule(['/modules/firmas/firmas.umd.js'], []);
    }
}
