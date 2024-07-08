<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tenant\DestroyTenantRequest;
use App\Http\Requests\Tenant\StoreTenantRequest;
use App\Http\Requests\Tenant\UpdateTenantRequest;
use App\Services\TenantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    protected TenantService $service;

    public function __construct(TenantService $service) {
        $this->service = $service;
    }

    /**
     * List user tenants
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $tenants = $this->service->index($request->user());

        return response()->json($tenants);
    }

    /**
     * Store user tenant
     *
     * @param StoreTenantRequest $request
     * @return JsonResponse
     */
    public function store(StoreTenantRequest $request): JsonResponse
    {
        $tenant = $this->service->store(
            $request->user(),
            $request->only([
                'name',
                'domain',
                'password',
            ])
        );

        return response()->json($tenant);
    }

    /**
     * Show user tenant
     *
     * @param Request $request
     * @param string $tenantId
     * @return void
     */
    public function show(Request $request, string $tenantId)
    {
        $tenant = $this->service->show(
            $request->user(),
            $tenantId
        );

        return response()->json($tenant);
    }

    /**
     * Update user tenant
     *
     * @param UpdateTenantRequest $request
     * @param string $tenantId
     * @return void
     */
    public function update(UpdateTenantRequest $request, string $tenantId)
    {
        $updated = $this->service->update(
            $request->user(),
            $request->input('password'),
            $request->only([
                'name',
                'domain',
            ]),
            $tenantId
        );

        return response()->json($updated);
    }

    /**
     * Destroy user tenant
     *
     * @param Request $request
     * @param string $tenantId
     * @return void
     */
    public function destroy(DestroyTenantRequest $request, string $tenantId)
    {
        $destroyed = $this->service->destroy(
            $request->user(),
            $request->input('password'),
            $tenantId
        );

        return response()->json($destroyed);
    }
}
