<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $permission =
      [
        'user-list',
        'user-create',
        'user-edit',
        'user-delete',

        'role-list',
        'role-create',
        'role-edit',
        'role-delete',

        // 'permission-list',
        // 'permission-create',
        // 'permission-edit',
        // 'permission-delete',

        'customer-list',
        'customer-create',
        'customer-edit',
        'customer-delete',

        'inventory-list',
        'inventory-create',
        'inventory-edit',
        'inventory-delete',

        'purchaseRecord-list',
        'purchaseRecord-create',
        'purchaseRecord-edit',
        'purchaseRecord-delete',

        'supplyRecord-list',
        'supplyRecord-create',
        'supplyRecord-edit',
        'supplyRecord-delete',

        'supplier-list',
        'supplier-create',
        'supplier-edit',
        'supplier-delete',
      ];
    foreach ($permission as $key => $value) {
      Permission::create(['name' => $value]);
    }
  }

}
