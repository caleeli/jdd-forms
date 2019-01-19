<?php

namespace Subcep\Firmas;

use App\Facades\JDD;
use Illuminate\Support\ServiceProvider;

class ServiceProvider extends ServiceProvider
{

    /**
     * Inicializa el modulo
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../dist' => public_path('modules/firmas'),
            ], 'public');
        JDD::addModule(['/modules/firmas/firmas.umd.js'], []);
    }
}
