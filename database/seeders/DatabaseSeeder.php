<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call(ClientsSeeder::class);
        $this->call(SallesSeeder::class);
        $this->call(ActivitesSeeder::class);
        $this->call(ReservationsSeeder::class);
        $this->call(AvisSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
