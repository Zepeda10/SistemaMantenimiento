<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgAntesToOrdens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordens', function (Blueprint $table) {
            $table->string('img_antes',150)->after('conclusion'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordens', function (Blueprint $table) {
            $table->dropColumn('img_antes');
        });
    }
}
