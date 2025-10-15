<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usuario genérico
        User::firstOrCreate(
            ['email' => 'alex@gmail.com'],
            [
                'name' => 'alex',
                'password' => bcrypt('41alex'),
            ]
        );

        // Usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('12345678'),
            ]
        );
        $admin->assignRole('admin');

        // Usuario empleado
        $empleado = User::firstOrCreate(
            ['email' => 'pepe@247.com'],
            [
                'name' => 'Pepe',
                'password' => Hash::make('12345678'),
            ]
        );
        $empleado->assignRole('empleado');
    }
}
