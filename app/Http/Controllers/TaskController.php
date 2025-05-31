<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $taskService;
    function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService; // use task service file
        $this->middleware('auth');
    }
    // get all tasks for user
    public function index(Request $request)
    {
        $perPage = $request->perPage ? $request->perPage : 10;
        $filters = $request->only(['status']);
        $filters["user_id"] = Auth::id();
        $tasks = $this->taskService->getAllUserTasks($filters, $perPage);
        return view('tasks.index', compact('tasks'));
    }

    // show task add page 
    function create()
    {
        return view('tasks.create');
    }
    // add new task 
    public function store(TaskRequest $request)
    {
        $this->taskService->createTask($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }
    // show task edit page 
    function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }
    // updating task 
    public function update(TaskRequest $request, Task $task)
    {
        $this->taskService->updateTask($task, $request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }


    // this is for ajax deletion of task , in real  project we need to make it in api route and api controller not on web controller
    public function destroy(Task $task)
    {
        try {
            $this->authorize('delete', $task);
            $this->taskService->deleteTask($task);

            return response()->json([
                'status' => 'success',
                'message' => 'Task deleted successfully',
                'task_id' => $task->id,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Task deletion failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete task',
            ], 500);
        }
    }

    // this is for ajax update task , in real  project we need to make it in api route and api controller not on web controller
    public function markDone(Task $task)
    {
        try {
            // $this->authorize('update', $task);
            $this->taskService->markTaskAsDone($task);
            return response()->json([
                'status' => 'success',
                'message' => 'Task marked as done',
                'task_id' => $task->id,
                'status_field' => 'completed',
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Task mark done failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to mark task as done',
            ], 500);
        }
    }
    // show tasks statistic 
    function dashboard()
    {
        $recentTasks = $this->taskService->getAllUserTasks(["user_id" => Auth::id()], 5);
        $tasks = $this->taskService->getUserTaskCountByStatus(Auth::user()->id);
        // Create a lookup map of status => count
        $taskCounts = $tasks->pluck('count', 'status');
        // Safely extract values with null coalescing
        $completed = $taskCounts['completed'] ?? 0;
        $pending = $taskCounts['pending'] ?? 0;
        $canceled = $taskCounts['canceled'] ?? 0;
        $total = $completed + $pending + $canceled;
        return view('tasks.dashboard', compact('recentTasks', 'tasks', 'total', 'completed', 'pending', 'canceled'));
    }
}
