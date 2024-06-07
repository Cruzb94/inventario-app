<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reproceso extends Model
{
    use HasFactory;

    public function entrada()
	{
		return $this->belongsTo('App\Models\Entrada');
	}


}
