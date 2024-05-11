<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

	public function products()
	{
		return $this->hasMany('App\Models\Product');
	}

}
