<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_correctivo_id')->nullable(); //Creando llave foránea 
            $table->unsignedBigInteger('material_id')->nullable(); //Creando llave foránea 

            $table->foreign('orden_correctivo_id') //Indicando llave foránea
                    ->references('id')->on('orden_correctivos')
                    ->onDelete('set null');

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
        Schema::dropIfExists('orden_materials');
    }
}
