<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Andjela',
            'email' => 'andjela@gmail.com',
            'password' => Hash::make('andjela'),
        ]);
        Player::factory()->count(456)->create([
            'user_id' => $user->id
        ]);
        Game::factory()->count(6)->create([
            'user_id' => $user->id
        ]);
    }
}
