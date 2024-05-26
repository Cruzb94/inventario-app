<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->date('fecha');
			$table->unsignedBigInteger('cuenta_id');
			$table->string('nequi');
			$table->float('efectivo');
			$table->string('descripcion');
            $table->timestamps();

            $table->foreign('cuenta_id')->references('id')->on('cuenta_bancos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingresos');
    }
}
