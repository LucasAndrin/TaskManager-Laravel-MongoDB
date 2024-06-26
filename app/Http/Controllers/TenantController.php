<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenantRequest;
use App\Services\TenantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function __construct(
        protected TenantService $service
    ) { }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTenantRequest $request): JsonResponse
    {
        $tenant = $this->service->store(
            $request->user(),
            $request->only([
                'name',
                'password',
            ])
        );

        return response()->json($tenant);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $tenantId)
    {
        $tenant = $this->service->show(
            $request->user(),
            $tenantId
        );

        return response()->json($tenant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $tenantId)
    {
        $affectedRows = $this->service->update(
            $request->user(),
            $tenantId,
            $request->only([
                'name',
            ])
        );

        return response()->json($affectedRows);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $tenantId)
    {
        $affectedRows = $this->service->destroy($request->user(), $tenantId);

        return response()->json($affectedRows);
    }
}
