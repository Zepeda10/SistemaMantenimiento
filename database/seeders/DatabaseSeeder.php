<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'  => 'Admin',
            'email'     => 'admin@gmail.com',
            'ap_paterno'     => 'ap 1',
            'ap_materno'     => 'ap 2',
            'telefono'     => '1111111111',
            'cargo'     => 'Administrador',
            'usuario'     => 'Admin',
            'password'  => bcrypt('123456'),
        ]);
    }
}
