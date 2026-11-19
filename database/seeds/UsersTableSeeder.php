<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = env('ADMIN_PASSWORD') ?: Str::random(16);

        User::insert([
            'name' => 'Admin',
            'email' => env('ADMIN_EMAIL', 'admin@example.com'),
            'password' => bcrypt($password),
        ]);

        if (isset($this->command)) {
            $this->command->info('Seeded admin account password: ' . $password);
        }
    }
}
