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
         */
        public function run(): void
        {
            $admin = Role::create(['name' => 'admin']);
            $cajero = Role::create(['name' => 'cajero']);

            $permissions = [
                'ver usuarios',
                'crear usuarios',
                'editar usuarios',
                'eliminar usuarios',

                'ver productos',
                'crear productos',
                'editar productos',
                'eliminar productos',

                'crear ventas',
                'ver ventas',
                'cancelar ventas',

                'abrir caja',
                'cerrar caja',
                'ver reportes'
            ];

            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }


            $admin->givePermissionTo(Permission::all());

            $cajero->givePermissionTo([
                'ver productos',
                'crear ventas',
                'ver ventas',
                'abrir caja',
                'cerrar caja',
            ]);
    }
}
