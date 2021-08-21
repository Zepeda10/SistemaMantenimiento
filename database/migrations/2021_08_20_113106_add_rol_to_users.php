<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRolToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable(); //Creando llave foránea 

            $table->foreign('role_id') //Indicando llave foránea
                    ->references('id')->on('roles')
                    ->onUpdate('cascade')
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

            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role_id');
            });
       
    }
}
