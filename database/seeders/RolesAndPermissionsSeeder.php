<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Reset cached roles and permissions
      app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

      // create permissions
      Permission::create(['name' => 'view courses']);  // Ajoutez cette ligne
      Permission::create(['name' => 'create courses']);
      Permission::create(['name' => 'edit courses']);
      Permission::create(['name' => 'delete courses']);
      Permission::create(['name' => 'publish courses']);
      Permission::create(['name' => 'unpublish courses']);

      // create roles and assign created permissions
      $role = Role::create(['name' => 'student'])
          ->givePermissionTo(['view courses']);

      $role = Role::create(['name' => 'instructor'])
          ->givePermissionTo(['view courses', 'create courses', 'edit courses', 'delete courses']);

      $role = Role::create(['name' => 'admin'])
          ->givePermissionTo(Permission::all());
    }
}
