<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Requests\TenantRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    protected TaskService $service;

    public function __construct(TaskService $service) {
        $this->service = $service;
    }

    /**
     * List tenant tasks
     *
     * @param TenantRequest $request
     * @return JsonResponse
     */
    public function index(TenantRequest $request): JsonResponse
    {
        $tasks = $this->service->index(
            $request->user(),
            $request->tenant()
        );

        return response()->json($tasks);
    }

    /**
     * Store tenant task
     *
     * @param StoreTaskRequest $request
     * @return void
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $this->service->store(
            $request->user(),
            $request->tenant(),
            $request->validated()
        );

        return response()->json($task);
    }

    /**
     * Show tenant task
     *
     * @param TenantRequest $request
     * @param string $taskId
     * @return JsonResponse
     */
    public function show(TenantRequest $request, string $taskId): JsonResponse
    {
        $task = $this->service->show(
            $request->user(),
            $request->tenant(),
            $taskId
        );

        return response()->json($task);
    }

    /**
     * Update tenant task
     *
     * @param UpdateTaskRequest $request
     * @param string $taskId
     * @return void
     */
    public function update(UpdateTaskRequest $request, string $taskId)
    {
        $updated = $this->service->update(
            $request->user(),
            $request->tenant(),
            $request->validated(),
            $taskId
        );

        return response()->json($updated);
    }

    /**
     * Destroy tenant task
     *
     * @param TenantRequest $request
     * @param string $taskId
     * @return JsonResponse
     */
    public function destroy(TenantRequest $request, string $taskId): JsonResponse
    {
        $deleted = $this->service->destroy(
            $request->user(),
            $request->tenant(),
            $taskId
        );

        return response()->json($deleted);
    }
}
