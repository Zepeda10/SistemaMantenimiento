<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCronogramaFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronograma_fechas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cronograma_preventivo_id')->nullable(); //Creando llave foránea 
            $table->unsignedBigInteger('fechas_preventivo_id')->nullable(); //Creando llave foránea 
            $table->timestamps();

            $table->foreign('cronograma_preventivo_id') //Indicando llave foránea
                    ->references('id')->on('cronograma_preventivos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('fechas_preventivo_id') //Indicando llave foránea
                    ->references('id')->on('fechas_preventivos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cronograma_fechas');
    }
}
