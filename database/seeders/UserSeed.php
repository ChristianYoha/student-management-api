<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Set Admin datas
        $admins = [
            [
                'name' => 'Karine',
                'email' => 'karine@admin.co',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'api_token' => Str::random(32)
            ],
            [
                'name' => 'Nicolas',
                'email' => 'nicolas@admin.co',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'api_token' => Str::random(32)
            ],
        ];
        foreach ($admins as $admin) {
            User::create($admin);
        }
    }
}
