<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MisCursos extends Model 
{

    //definir que campo de la tabla es la llave primaria
    //protected $primaryKey = 'id';
    //protected $keyType = 'id';
    //public $incrementing = true;

    protected $fillable = [
        'id', 'curso','alumno'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}