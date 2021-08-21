<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificacionesFirmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verificaciones_firmas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('verificacion_id')->nullable(); //Creando llave foránea
            $table->string('nombre',100);
            $table->timestamps();

            $table->foreign('verificacion_id') //Indicando llave foránea
                    ->references('id')->on('verificacions')
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
        Schema::dropIfExists('verificaciones_firmas');
    }
}
