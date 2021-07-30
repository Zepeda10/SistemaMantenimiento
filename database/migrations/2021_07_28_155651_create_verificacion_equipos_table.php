<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificacionEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verificacion_equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('verificacion_id')->nullable(); //Creando llave foránea 
            $table->unsignedBigInteger('equipo_id')->nullable(); //Creando llave foránea 
            $table->timestamps();

            $table->foreign('verificacion_id') //Indicando llave foránea
                    ->references('id')->on('verificacions')
                    ->onDelete('set null');

            $table->foreign('equipo_id') //Indicando llave foránea
                    ->references('id')->on('equipos')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verificacion_equipos');
    }
}
