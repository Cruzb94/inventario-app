<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
			$table->integer('product_id');
			$table->date('fecha');
			$table->integer('cantidad');
			$table->integer('operario_id');
			$table->integer('reproceso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entradas');
    }
}
