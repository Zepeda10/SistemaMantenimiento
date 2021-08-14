<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImgCompusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_compus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipo_id')->nullable(); //Creando llave foránea
            $table->string('arriba',150)->nullable();
            $table->string('abajo',150)->nullable();
            $table->string('frente',150)->nullable();
            $table->string('atras',150)->nullable();
            $table->string('disco',50)->nullable();
            $table->string('ram',50)->nullable();
            $table->string('procesador',50)->nullable();
            $table->timestamps(); 

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
        Schema::dropIfExists('img_compus');
    }
}
