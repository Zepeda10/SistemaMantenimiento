<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyRegistros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registros', function (Blueprint $table) {
            $table->unsignedBigInteger('departamento_id')->nullable(); //Creando llave foránea

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
        Schema::table('registros', function (Blueprint $table) {
            $table->dropColumn('departamento_id');
        });
    }
}
