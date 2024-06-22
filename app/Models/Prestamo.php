<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_libro', 
        'id_usuario', 
        'fecha_inicio', 
        'fecha_devolucion', 
        'estado'
    ];

    public $timestamps = false;

    /**
     * Relación con el modelo Libro
     */
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'id_libro');
    }

    /**
     * Relación con el modelo User
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}

