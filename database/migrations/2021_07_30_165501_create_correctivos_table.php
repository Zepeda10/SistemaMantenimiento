<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrectivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correctivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('departamento_id')->nullable(); //Creando llave foránea
            $table->unsignedBigInteger('equipo_id')->nullable(); //Creando llave foránea
            $table->string('no_inventario',100); 
            $table->string('prioridad',100); 
            $table->string('problema',250); 
            $table->string('observaciones',250); 
            $table->timestamps();

            $table->foreign('departamento_id') //Indicando llave foránea
                    ->references('id')->on('departamentos')
                    ->onDelete('set null');

            $table->foreign('equipo_id') //Indicando llave foránea
                    ->references('id')->on('equipos')
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
        Schema::dropIfExists('correctivos');
    }
}
