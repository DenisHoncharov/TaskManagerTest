<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TaskApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $userTasks = Auth::user()->tasks;

        return response()->json([
            'tasks' => $userTasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request): JsonResponse
    {
        $task = Auth::user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return response()->json([
            'task' => $task
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $task): JsonResponse
    {
        $task = Auth()->user()->tasks()->where('id', $task)->firstOrFail();

        return response()->json([
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, int $task): JsonResponse
    {
        $task = Auth()->user()->tasks()->where('id', $task)->firstOrFail();

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;

        $task->update();

        return response()->json([
            'task' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $task): JsonResponse
    {
        $task = Auth()->user()->tasks()->where('id', $task)->firstOrFail();

        $task->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
