<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $categories = [
            ['name' => 'Anticipo Cliente', 'type' => 'income', 'color' => '#10B981'],
            ['name' => 'Pago Final', 'type' => 'income', 'color' => '#34D399'],
            ['name' => 'Globos', 'type' => 'expense', 'color' => '#EF4444'],
            ['name' => 'Bases/Estructuras', 'type' => 'expense', 'color' => '#F87171'],
            ['name' => 'Transporte', 'type' => 'expense', 'color' => '#FBBF24'],
            ['name' => 'Personal', 'type' => 'expense', 'color' => '#60A5FA'],
        ];

        foreach ($categories as $category) {
            $user->categories()->create($category);
        }
    }
}
