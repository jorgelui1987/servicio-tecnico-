<?php

namespace App\Http\Controllers;

use App\Models\Reparacion;
use App\Models\Configuracion;
use Illuminate\Http\Request;

class PublicReparacionController extends Controller
{
    /**
     * Vista pública para que el cliente escanee el QR
     * y vea el estado de su reparación, condiciones y garantía.
     */
    public function status($numero_orden)
    {
        $reparacion = Reparacion::withoutGlobalScopes()
            ->with(['cliente', 'tecnico'])
            ->where('numero_orden', $numero_orden)
            ->firstOrFail();

        // Obtener datos del tenant al que pertenece la reparación
        $empresa = Configuracion::where('tenant_id', $reparacion->tenant_id)->first();

        // Si no hay configuración, crear un objeto con valores por defecto
        if (!$empresa) {
            $empresa = (object) [
                'nombre_tienda'     => 'CRM Celulares',
                'ruc'               => '',
                'direccion'         => '',
                'telefono'          => '',
                'email'             => '',
                'logo'              => null,
                'terminos_garantia' => '',
            ];
        }

        return view('reparaciones.public-status', compact('reparacion', 'empresa'));
    }
}