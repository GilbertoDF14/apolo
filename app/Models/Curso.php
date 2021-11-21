<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model 
{

    //definir que campo de la tabla es la llave primaria
    //protected $primaryKey = 'id';
    //protected $keyType = 'id';
    //public $incrementing = true;

    protected $fillable = [
        'id', 'profesor','nombre','duracion'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}