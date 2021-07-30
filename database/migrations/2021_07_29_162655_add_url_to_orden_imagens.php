<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlToOrdenImagens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_imagens', function (Blueprint $table) {
            $table->string('url',100)->after('id'); 
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
            $table->dropColumn('url');
        });
    }
}
