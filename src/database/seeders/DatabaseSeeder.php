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
        if (\App\Models\User::doesntExist()) {
            \App\Models\User::factory()->createMany([
                ['name' => 'Alice', 'email' => 'alice@mail.com'],
                ['name' => 'Bob', 'email' => 'bob@mail.com'],
            ]);
        }

        \App\Models\Reminder::factory(10)->create();
    }
}
