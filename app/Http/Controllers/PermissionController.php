<?php

namespace App\Http\Controllers;

use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    protected PermissionService $service;

    public function __construct(PermissionService $service) {
        $this->service = $service;
    }

    /**
     * List permissions
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $permissions = $this->service->index();

        return response()->json($permissions);
    }
}
