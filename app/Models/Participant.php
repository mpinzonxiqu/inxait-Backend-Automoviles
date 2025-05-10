<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    // Agrega los campos que deseas permitir para asignación masiva
    protected $fillable = [
        'nombre', 'apellido', 'cedula', 'departamento',
        'ciudad', 'celular', 'email', 'habeas_data'
    ];
}



