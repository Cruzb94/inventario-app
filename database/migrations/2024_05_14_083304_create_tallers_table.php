<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTallersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tallers', function (Blueprint $table) {
            $table->id();
			$table-> string('nombre');
			$table->string('referencia');
			$table->string('descripcion');
			$table->date('fecha');
			$table->integer('cantidad');
			$table->float('valor_unidad');
			$table->float('valor_total');
			$table->string('observaciones');
			$table->integer('reprocesos');
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
        Schema::dropIfExists('tallers');
    }
}
