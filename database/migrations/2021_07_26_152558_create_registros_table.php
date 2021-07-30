<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->string('name',80);
            $table->string('ap_paterno',80); 
            $table->string('ap_materno',80); 
            $table->string('telefono',12);
            $table->string('email',150)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('cargo',80);
            $table->string('usuario',80);
            $table->string('password');
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
        Schema::dropIfExists('registros');
    }
}
