<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNombreToDepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departamentos', function (Blueprint $table) {
            $table->string('nombre',100)->after('id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departamentos', function (Blueprint $table) {
            $table->dropColumn('nombre');
        });
    }
}
