<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $service;

    public function __construct(UserService $service) {
        $this->service = $service;
    }

    /**
     * List users
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $users = $this->service->index(
            $request->user()
        );

        return response()->json($users);
    }

    /**
     * Add user by id to tenant
     *
     * @param TenantRequest $request
     * @param string $userId
     * @return JsonResponse
     */
    public function add(TenantRequest $request, string $userId): JsonResponse
    {
        $added = $this->service->add(
            $request->user(),
            $request->tenant(),
            $userId
        );

        return response()->json($added);
    }

    /**
     * Remove user by id from tenant
     *
     * @param TenantRequest $request
     * @param string $userId
     * @return JsonResponse
     */
    public function remove(TenantRequest $request, string $userId): JsonResponse
    {
        $removed = $this->service->remove(
            $request->user(),
            $request->tenant(),
            $userId
        );

        return response()->json($removed);
    }
}
