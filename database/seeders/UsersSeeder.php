<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $roleAdmin = Role::where('nom', ROLE::ADMIN)->first();
        $roleVisiteur = Role::where('nom', ROLE::VISITEUR)->first();
        $robert = User::factory([
            'name' => 'Robert Duchmol',
            'email' => 'robert.duchmol@domain.fr',
            'password' => Hash::make('GrosSecret'),
        ]) ->create();
        $robert->roles()->attach([$roleAdmin->id, $roleVisiteur->id]);
        $gerard = User::factory([
            'name' => 'Gérard Martin',
            'email' => 'gerard.martin@domain.fr',
            'password' => Hash::make('GrosSecret'),
        ]) ->create();
        User::factory(18)->create();
        $users = User::where('id', '!=', $robert->id)->get();
        foreach ($users as $user) {
            $user->roles()->attach($roleVisiteur->id);
        }
    }
}
