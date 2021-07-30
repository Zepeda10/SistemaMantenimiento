<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->string('tipo',100); 
            $table->unsignedBigInteger('user_id')->nullable(); //Creando llave foránea
            $table->string('nombre',100); 
            $table->string('fecha',100); 
            $table->unsignedBigInteger('departamento_id')->nullable(); //Creando llave foránea
            $table->string('refacciones',200); 
            $table->string('materiales',200); 
            $table->string('resumen',300); 
            $table->string('conclusion',300); 

            $table->foreign('user_id') //Indicando llave foránea
                    ->references('id')->on('users')
                    ->onDelete('set null');

            $table->foreign('departamento_id') //Indicando llave foránea
                    ->references('id')->on('departamentos')
                    ->onDelete('set null');

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
        Schema::dropIfExists('ordens');
    }
}
