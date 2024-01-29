<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::where('nom', ROLE::ADMIN)->first();

        $roleVisiteur = Role::where('nom', ROLE::VISITEUR)->first();

        $robert = User::factory([
            'name'=>'Robert duchmol',
            'email' => 'robert.duchmol@gmail.com',
            'password'=>Hash::make('123456789')
        ]);

        $robert->roles()->attach([$roleAdmin->id, $roleVisiteur->id]);

    }
}
