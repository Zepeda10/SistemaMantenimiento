<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrdenIdToOrdenImagens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_imagens', function (Blueprint $table) {
            $table->unsignedBigInteger('orden_id')->nullable(); //Creando llave foránea

            $table->foreign('orden_id') //Indicando llave foránea
                    ->references('id')->on('ordens')
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
        Schema::table('orden_imagens', function (Blueprint $table) {
            $table->dropColumn('orden_id');
        });
    }
}
