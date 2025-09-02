<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsientoContable extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'descripcion',
        'monto_debe',
        'monto_haber',
        'cuenta_debe',
        'cuenta_haber',
    ];
}
