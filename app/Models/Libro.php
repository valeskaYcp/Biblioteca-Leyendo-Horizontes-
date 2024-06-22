<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_libro',
        'año',
        'autor',
        'editorial',
        'genero',
        'disponible'
    ];

    /**
     * Relación con el modelo Prestamo
     */
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'id_libro');
    }
}

