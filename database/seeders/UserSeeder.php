<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $username = ['gebby','dzaky','dede','admin3'];
        $password = ['gebby','dzaky','dede','admin3'];
        $name = ['Gebby','Dzaky','Dede','anjing'];
        $role = ['superuser','admin','admin','admin'];

        for ($i=0; $i < 3; $i++) { 
            User::create([
                'username' => $username[$i],
                'password' => Hash::make($password[$i]),
                'name' => $name[$i],
                'role' => $role[$i],
            ]);
        }
    }
}
