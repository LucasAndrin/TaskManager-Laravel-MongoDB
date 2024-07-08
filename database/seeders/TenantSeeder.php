<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\TenantService;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    protected TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '1234',
        ]);

        $this->tenantService->store($admin, [
            'name' => 'Tenant Admin',
            'password' => '1234',
            'domain' => 'admin',
        ]);
    }
}
