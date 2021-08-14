<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenCorrectivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_correctivos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_mantenimiento',100); 
            $table->string('tipo_servicio',100);
            $table->unsignedBigInteger('user_id')->nullable(); //Creando llave foránea
            $table->string('nombre',100); 
            $table->string('fecha',100); 
            $table->unsignedBigInteger('correctivo_id')->nullable(); //Creando llave foránea
            $table->string('refacciones',200); 
            $table->string('materiales',200); 
            $table->string('resumen',300); 
            $table->string('conclusion',300); 
            $table->string('img_antes',300); 
            $table->string('img_despues',300); 

            $table->foreign('user_id') //Indicando llave foránea
                    ->references('id')->on('users')
                    ->onDelete('set null');

            $table->foreign('correctivo_id') //Indicando llave foránea
                    ->references('id')->on('correctivos')
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
        Schema::dropIfExists('orden_correctivos');
    }
}
