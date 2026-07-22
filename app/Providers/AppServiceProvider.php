<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Configuracion;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Compartir datos de la empresa con todas las vistas
        View::composer('*', function ($view) {
            // Solo agregar empresa si la vista no la tiene ya definida
            // (permite que controladores públicos pasen su propia $empresa)
            $viewData = $view->getData();
            if (array_key_exists('empresa', $viewData)) {
                return;
            }

            try {
                $empresa = Configuracion::empresa();
            } catch (\Exception $e) {
                $empresa = null;
            }

            // Si no hay configuración, crear un objeto con valores por defecto
            if (!$empresa) {
                $empresa = (object) [
                    'nombre_tienda'    => 'CRM Celulares',
                    'ruc'              => '',
                    'direccion'        => '',
                    'telefono'         => '',
                    'whatsapp'         => '',
                    'email'            => '',
                    'logo'             => null,
                    'igv'              => 18,
                    'moneda'           => 'PEN',
                    'simbolo_moneda'   => 'S/.',
                    'terminos_garantia' => '',
                ];
            }

            $view->with('empresa', $empresa);
        });
    }
}
