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
            'tasks' => collect(['list', 'show', 'store', 'update', 'destroy', 'assign', 'perform'])
        ]);

        Permission::factory()->createMany(
            $resources->flatMap(function (Collection $actions, string $resource) {
                return $actions->map(fn (string $action) => [
                    'name' => ucfirst($resource).' '.ucfirst($action),
                    'alias' => $resource.'.'.$action
                ]);
            })->toArray()
        );
    }
}
