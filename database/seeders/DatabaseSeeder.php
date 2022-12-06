<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(ProductSeeder::class);
        $this->call(DonorSeeder::class);
        $this->call(IslandSeeder::class);
        $this->call(FishCenterSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(NavbarSeeder::class);
    }
}
