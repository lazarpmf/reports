<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Lazar',
            'email' => 'laki1970berane@gmail.com',
            'role' => 1,
            'password' => bcrypt('lakilaki'),
        ]);
    }
}
