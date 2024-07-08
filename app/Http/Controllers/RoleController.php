<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\AllowRoleRequest;
use App\Http\Requests\Role\AssignRoleRequest;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Requests\TenantRequest;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    protected RoleService $service;

    public function __construct(RoleService $service) {
        $this->service = $service;
    }

    /**
     * List tenant roles
     *
     * @param TenantRequest $request
     * @return JsonResponse
     */
    public function index(TenantRequest $request): JsonResponse
    {
        $roles = $this->service->index(
            $request->user(),
            $request->tenant()
        );

        return response()->json($roles);
    }

    /**
     * Store tenant role
     *
     * @param StoreRoleRequest $request
     * @return void
     */
    public function store(StoreRoleRequest $request)
    {
        $role = $this->service->store(
            $request->user(),
            $request->tenant(),
            $request->validated()
        );

        return response()->json($role);
    }

    /**
     * Show tenant role
     *
     * @param TenantRequest $request
     * @param string $roleId
     * @return JsonResponse
     */
    public function show(TenantRequest $request, string $roleId): JsonResponse
    {
        $role = $this->service->show(
            $request->user(),
            $request->tenant(),
            $roleId
        );

        return response()->json($role);
    }

    /**
     * Update tenant role
     *
     * @param UpdateRoleRequest $request
     * @param string $roleId
     * @return JsonResponse
     */
    public function update(UpdateRoleRequest $request, string $roleId): JsonResponse
    {
        $updated = $this->service->update(
            $request->user(),
            $request->tenant(),
            $request->validated(),
            $roleId
        );

        return response()->json($updated);
    }

    /**
     * Destroy tenant role
     *
     * @param TenantRequest $request
     * @param string $roleId
     * @return JsonResponse
     */
    public function destroy(TenantRequest $request, string $roleId): JsonResponse
    {
        $deleted = $this->service->destroy(
            $request->user(),
            $request->tenant(),
            $roleId
        );

        return response()->json($deleted);
    }

    /**
     * Assign tenat roles to users
     *
     * @param AssignRoleRequest $request
     * @param string $roleId
     * @return JsonResponse
     */
    public function assign(AssignRoleRequest $request, string $roleId): JsonResponse
    {
        $synced = $this->service->assign(
            $request->user(),
            $request->tenant(),
            $request->input('user_ids'),
            $roleId
        );

        return response()->json($synced);
    }

    /**
     * Allow tenant roles to permissions
     *
     * @param AllowRoleRequest $request
     * @param string $roleId
     * @return JsonResponse
     */
    public function allow(AllowRoleRequest $request, string $roleId): JsonResponse
    {
        $synced = $this->service->allow(
            $request->user(),
            $request->tenant(),
            $request->input('permission_ids'),
            $roleId
        );

        return response()->json($synced);
    }
}
