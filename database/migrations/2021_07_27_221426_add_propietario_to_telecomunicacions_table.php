<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPropietarioToTelecomunicacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('telecomunicacions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); //Creando llave foránea

            $table->foreign('user_id') //Indicando llave foránea
                    ->references('id')->on('users')
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
        Schema::table('telecomunicacions', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
