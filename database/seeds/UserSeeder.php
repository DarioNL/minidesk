<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            'id' => 'b3b2c903-55d9-40a9-a8db-e2c1bfb5352d',
            'first_name' => 'John',
            'last_name' => 'Doo',
            'email' => 'admin@minidesk.nl',
            'password' => bcrypt('@Minidesk'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

    }
}

