<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

	public function producto()
	{
		return $this->belongsTo('App\Models\Producto');
	}

	public function operario()
	{
		return $this->belongsTo('App\Models\Operario');
	}

	public function reproceso()
	{
		return $this->hasMany('App\Models\Reproceso');
	}

}
