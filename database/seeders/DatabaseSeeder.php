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
        $this->call([
            ConfigurationSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            MenuSubOneSeeder::class,
            MenuSubTwoSeeder::class,
            FileManagerSeeder::class
        ]);
    }
}
