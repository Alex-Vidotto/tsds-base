<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::findOrCreate('ver servicios');
        Permission::findOrCreate('crear servicios');
        Permission::findOrCreate('editar servicios');
        Permission::findOrCreate('borrar servicios');

        Permission::findOrCreate('ver autos');
        Permission::findOrCreate('crear autos');
        Permission::findOrCreate('editar autos');
        Permission::findOrCreate('borrar autos');

        Permission::findOrCreate('ver fechas de mantenimiento');
        Permission::findOrCreate('crear fechas de mantenimiento');
        Permission::findOrCreate('editar fechas de mantenimiento');
        Permission::findOrCreate('borrar fechas de mantenimiento');

        Permission::findOrCreate('ver grupo de trabajo');
        Permission::findOrCreate('crear grupo de trabajo');
        Permission::findOrCreate('editar grupo de trabajo');
        Permission::findOrCreate('borrar grupo de trabajo');

        Permission::findOrCreate('ver tareas');
        Permission::findOrCreate('crear tareas');
        Permission::findOrCreate('editar tareas');
        Permission::findOrCreate('borrar tareas');

        Permission::findOrCreate('ver usuario');
        Permission::findOrCreate('crear usuario');
        Permission::findOrCreate('editar usuario');
        Permission::findOrCreate('borrar usuario');

        Permission::findOrCreate('ver grupo de trabajo');
        Permission::findOrCreate('crear grupo de trabajo');
        Permission::findOrCreate('editar grupo de trabajo');
        Permission::findOrCreate('borrar grupo de trabajo');

        // crear roles
        $admin = Role::findOrCreate('admin');
        $empleado = Role::findOrCreate('empleado');

        // asignar permiso
        $admin->givePermissionTo(Permission::all());
        $empleado->givePermissionTo([
            'ver servicios',
            'ver autos',
            'ver tareas',
        ]);

    }
}
