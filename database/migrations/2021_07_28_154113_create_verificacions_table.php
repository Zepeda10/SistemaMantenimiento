<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verificacions', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('verificacions');
    }
}
