<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  public function run()
  {
    User::factory()->admin()->create([
      'name' => 'Admin User',
      'username' => 'admin',
      'email' => 'admin@example.com',
    ]);

    User::factory(10)->create();
  }
}
