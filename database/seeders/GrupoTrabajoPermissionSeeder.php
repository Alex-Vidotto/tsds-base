<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class GrupoTrabajoPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Lista de permisos del módulo Grupo de Trabajo
        $permisos = [
            'ver grupo de trabajo',
            'crear grupo de trabajo',
            'editar grupo de trabajo',
            'borrar grupo de trabajo',
        ];

        // Crear los permisos si no existen
        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear o encontrar el rol admin
        $rolAdmin = Role::firstOrCreate(['name' => 'admin']);

        // Asignar permisos al rol admin
        $rolAdmin->givePermissionTo($permisos);

        // Asignar el rol admin al primer usuario (ajustá el ID si hace falta)
        $user = User::find(1);
        if ($user && !$user->hasRole('admin')) {
            $user->assignRole('admin');
        }

        echo "✅ Seeder ejecutado correctamente: permisos de Grupo de Trabajo creados y asignados.\n";
    }
}
