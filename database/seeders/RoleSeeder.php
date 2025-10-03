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

        Permission::create(['name'=> 'ver autos']);
        Permission::create(['name'=> 'crear autos']);
        Permission::create(['name'=> 'editar autos']);
        Permission::create(['name'=> 'borrar autos']);

        Permission::create(['name'=> 'ver fechas de mantenimiento']);
        Permission::create(['name'=> 'crear fechas de mantenimiento']);
        Permission::create(['name'=> 'editar fechas de mantenimiento']);
        Permission::create(['name'=> 'borrar fechas de mantenimiento']);


        //crear roles
        $admin = Role::create(['name' => 'admin']);
        $empleado = Role::create(['name' => 'emmpleado']);

        //asignar permiso
        $admin->givePermissionTo(Permission::all());
        $empleado->givePermissionTo(['ver servicios']);
    }
}
