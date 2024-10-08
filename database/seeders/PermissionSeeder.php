<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class PermissionSeeder extends Seeder
{
    /**
     * Create default permissions
     */
    public function run(): void
    {
        $resources = collect([
            'permissios' => collect([
                'view' => 'Can see available permissions',
            ]),
            'users' => collect([
                'add' => 'Can add users to the tenant',
                'remove' => 'Can remove tenant users',
            ]),
            'roles' => collect([
                'view' => 'Can view tenant roles',
                'store' => 'Can store tenant roles',
                'update' => 'Can update tenant roles',
                'destroy' => 'Can destroy tenant roles',
                'assign' => 'Can assign tenant roles to users',
                'allow' => 'Can allow tenant roles to permissions',
            ]),
            'tasks' => collect([
                'view' => 'Can view tasks',
                'store' => 'Can store tasks',
                'update' => 'Can update tasks',
                'assign' => 'Can assign tasks',
                'execute' => 'Can execute tasks',
                'destroy' => 'Can destroy tasks'
            ])
        ]);

        Permission::factory()->createMany(
            $resources->flatMap(function (Collection $actions, string $resource) {
                return $actions->map(function (string $description, string $action) use ($resource) {
                    return [
                        'name' => ucfirst($resource).' '.ucfirst($action),
                        'alias' => $resource.'.'.$action,
                        'description' => $description
                    ];
                })->values();
            })->toArray()
        );
    }
}
