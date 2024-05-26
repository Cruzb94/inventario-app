<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaBanco extends Model
{
    use HasFactory;

    public function ingresos()
	{
		return $this->hasMany('App\Models\Ingreso');
	}

}
