<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //\App\Models\User::factory(10)->create();

        User::factory(10)->create();
        User::create([
            'name'=>'Taufiq B',
            'email'=>'taufiqb@gmail.com',
            'email_verified_at'=>now(),
            'role'=>'admin',
            'password'=>'12345',
        ]);

        //
    }
}
