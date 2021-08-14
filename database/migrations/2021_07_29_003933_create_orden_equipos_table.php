<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_id')->nullable(); //Creando llave foránea 
            $table->unsignedBigInteger('equipo_id')->nullable(); //Creando llave foránea 

            $table->foreign('orden_id') //Indicando llave foránea
                    ->references('id')->on('ordens')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('equipo_id') //Indicando llave foránea
                    ->references('id')->on('equipos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('orden_equipos');
    }
}
