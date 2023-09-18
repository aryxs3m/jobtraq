<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    private const ROLES = [
        'Üzemeltető' => [
            'view scraper-logs',
        ],
        'Cikkíró' => [
            'view articles',
            'add articles',
            'edit articles',
            'delete articles',
            'publish articles',
        ],
        'Lektor' => [
            'view articles',
            'edit articles',
            'publish articles',
        ],
        'Moderátor' => [
            'view articles',
            'view comments',
            'moderate comments',
            'op comments',
        ],
        'Média kezelő' => [
            'view images',
            'upload images',
            'delete images',
        ],
        'Scraper kezelő' => [
            'view scraper-keywords',
            'add scraper-keywords',
            'edit scraper-keywords',
            'delete scraper-keywords',
        ],
        'Kimutatás kezelő' => [
            'view listings',
            'reparse listings',
            'scrape listings',
            'view job-positions',
            'add job-positions',
            'edit job-positions',
            'delete job-positions',
            'view job-levels',
            'order job-levels',
            'add job-levels',
            'edit job-levels',
            'delete job-levels',
            'view job-stacks',
            'add job-stacks',
            'edit job-stacks',
            'delete job-stacks',
            'view locations',
            'add locations',
            'edit locations',
            'delete locations',
            'view countries',
            'add countries',
            'edit countries',
            'delete countries',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view scraper-logs']);

        Permission::create(['name' => 'view articles']);
        Permission::create(['name' => 'add articles']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);

        Permission::create(['name' => 'view comments']);
        Permission::create(['name' => 'moderate comments']);
        Permission::create(['name' => 'op comments']);

        Permission::create(['name' => 'view images']);
        Permission::create(['name' => 'upload images']);
        Permission::create(['name' => 'delete images']);

        Permission::create(['name' => 'view listings']);
        Permission::create(['name' => 'reparse listings']);
        Permission::create(['name' => 'scrape listings']);

        Permission::create(['name' => 'view scraper-keywords']);
        Permission::create(['name' => 'add scraper-keywords']);
        Permission::create(['name' => 'edit scraper-keywords']);
        Permission::create(['name' => 'delete scraper-keywords']);

        Permission::create(['name' => 'view job-positions']);
        Permission::create(['name' => 'add job-positions']);
        Permission::create(['name' => 'edit job-positions']);
        Permission::create(['name' => 'delete job-positions']);

        Permission::create(['name' => 'view job-levels']);
        Permission::create(['name' => 'order job-levels']);
        Permission::create(['name' => 'add job-levels']);
        Permission::create(['name' => 'edit job-levels']);
        Permission::create(['name' => 'delete job-levels']);

        Permission::create(['name' => 'view job-stacks']);
        Permission::create(['name' => 'add job-stacks']);
        Permission::create(['name' => 'edit job-stacks']);
        Permission::create(['name' => 'delete job-stacks']);

        Permission::create(['name' => 'view locations']);
        Permission::create(['name' => 'add locations']);
        Permission::create(['name' => 'edit locations']);
        Permission::create(['name' => 'delete locations']);

        Permission::create(['name' => 'view countries']);
        Permission::create(['name' => 'add countries']);
        Permission::create(['name' => 'edit countries']);
        Permission::create(['name' => 'delete countries']);

        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'add users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Role::create(['name' => 'Adminisztrátor']);

        foreach (self::ROLES as $role => $permissions) {
            Role::create(['name' => $role])
                ->givePermissionTo($permissions);
        }
    }
}
