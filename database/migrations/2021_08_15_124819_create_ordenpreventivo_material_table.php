<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenpreventivoMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenpreventivo_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_id')->nullable(); //Creando llave foránea 
            $table->unsignedBigInteger('material_id')->nullable(); //Creando llave foránea 

            $table->foreign('orden_id') //Indicando llave foránea
                    ->references('id')->on('ordens')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('material_id') //Indicando llave foránea
                    ->references('id')->on('materials')
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
        Schema::dropIfExists('ordenpreventivo_material');
    }
}
