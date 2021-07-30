<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelecomunicacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telecomunicacions', function (Blueprint $table) {
            $table->id();
            $table->string('tipo',50); 
            $table->string('aula',100);
            $table->string('edificio',50);  
            $table->string('problema',250); 
            $table->unsignedBigInteger('departamento_id')->nullable(); //Creando llave foránea
            $table->timestamps();

            $table->foreign('departamento_id') //Indicando llave foránea
            ->references('id')->on('departamentos')
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
        Schema::dropIfExists('telecomunicacions');
    }
}
