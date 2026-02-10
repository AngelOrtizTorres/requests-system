<?php

namespace Database\Seeders;

use App\Models\Request;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(RoleSeeder::class);
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234'),
            ])->assignRole('admin');
        User::factory()->create([
            'name' => 'Boss User',
            'email' => 'boss@boss.com',
            'password' => bcrypt('1234'),
            ])->assignRole('boss');
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('1234'),
            ])->assignRole('user');
        
        User::factory(30)->create();
        Tag::factory(5)->create();
        Request::factory(50)->create();
    }
}
