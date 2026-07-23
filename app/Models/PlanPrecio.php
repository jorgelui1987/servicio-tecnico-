<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanPrecio extends Model
{
    protected $table = 'plan_precios';

    protected $fillable = [
        'plan_key',
        'nombre',
        'precio_mensual',
        'moneda',
        'simbolo',
        'descripcion',
        'activo',
    ];

    protected $casts = [
        'precio_mensual' => 'decimal:2',
        'activo' => 'boolean',
    ];

    /**
     * Obtener todos los planes activos con sus precios.
     */
    public static function getPlanesActivos()
    {
        return static::where('activo', true)->get()->keyBy('plan_key');
    }

    /**
     * Obtener el precio formateado de un plan.
     */
    public function precioFormateado()
    {
        if ($this->precio_mensual == 0) {
            return $this->simbolo . '0';
        }
        return $this->simbolo . number_format($this->precio_mensual, $this->precio_mensual == floor($this->precio_mensual) ? 0 : 2);
    }
}