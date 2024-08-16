<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'name' => 'admin',
          'email' => 'admin@gmail.com',
          'password' => bcrypt('12345678'),
          'address' => 'Bandung',
          'date_of_birth' => '2002-12-23',
          'phone' => '+62821141412',
          'role' => 'admin',
        ]);

        User::create([
          'name' => 'nasabah',
          'email' => 'nasabah@gmail.com',
          'password' => bcrypt('12345678'),
          'address' => 'Bandung',
          'date_of_birth' => '2002-12-23',
          'phone' => '+62821141412',
          'role' => 'nasabah',
        ]);
    }
}
