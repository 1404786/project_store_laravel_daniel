<?php

use Illuminate\Database\Seeder;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Daniel Alves Bezerra',
            'email' => 'daniel@appfacilita.com',
            'password'=> bcrypt('123456'),

        ]);

        User::create([
            'name' => 'Daniel Alves Bezerra',
            'email' => 'contato@appfacilita.com',
            'password'=> bcrypt('123456'),

        ]);
    }
}
