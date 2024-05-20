<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(ImagesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        // Seed the users table first
        $this->call(UserTableSeeder::class);
        $this->call(RegistersTableSeeder::class);
        $this->call(NotesTableSeeder::class);
        $this->call(TaskTableSeeder::class);


    }
}
