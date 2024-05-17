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
			$table->unsignedBigInteger('operario_id');
			$table->text('referencia');
			$table->date('fecha');
			$table->float('valor_total');
			$table->string('observaciones');
			$table->integer('reprocesos');
            $table->timestamps();

            $table->foreign('operario_id')->references('id')->on('operarios');
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
