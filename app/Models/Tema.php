<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model 
{

    protected $fillable = [
        'id', 'curso','nombre'
    ];

    protected $hidden = [
    ];
}