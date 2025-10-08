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
        
        // ...existing code...
        Permission::firstOrCreate(['name'=> 'ver autos']);
        Permission::firstOrCreate(['name'=> 'crear servicios']);
        Permission::firstOrCreate(['name'=> 'editar servicios']);
        Permission::firstOrCreate(['name'=> 'borrar servicios']);

        Permission::firstOrCreate(['name'=> 'ver servicios']);
        Permission::firstOrCreate(['name'=> 'crear autos']);
        Permission::firstOrCreate(['name'=> 'editar autos']);
        Permission::firstOrCreate(['name'=> 'borrar autos']);

        Permission::firstOrCreate(['name'=> 'ver fechas de mantenimiento']);
        Permission::firstOrCreate(['name'=> 'crear fechas de mantenimiento']);
        Permission::firstOrCreate(['name'=> 'editar fechas de mantenimiento']);
        Permission::firstOrCreate(['name'=> 'borrar fechas de mantenimiento']);

        Permission::firstOrCreate(['name'=> 'ver grupo de trabajo']);
        Permission::firstOrCreate(['name'=> 'crear grupo de trabajo']);
        Permission::firstOrCreate(['name'=> 'editar grupo de trabajo']);
        Permission::firstOrCreate(['name'=> 'borrar grupo de trabajo']);
        // ...existing code...



        //crear roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $empleado = Role::firstOrCreate(['name' => 'emmpleado']);

        //asignar permiso
        $admin->givePermissionTo(Permission::all());
        $empleado->givePermissionTo(['ver servicios']);
    }
};
