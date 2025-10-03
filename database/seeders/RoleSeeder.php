<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //crear permiso
        Permission::create(['name'=> 'ver servicios']);
        Permission::create(['name'=> 'crear servicios']);
        Permission::create(['name'=> 'editar servicios']);
        Permission::create(['name'=> 'borrar servicios']);

        //crear roles
        $admin = Role::create(['name' => 'admin']);
        $empleado = Role::create(['name' => 'emmpleado']);

        //asignar permiso
        $admin->givePermissionTo(Permission::all());
        $empleado->givePermissionTo(['ver servicios']);
    }
}
