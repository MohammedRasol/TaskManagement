<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function getAllUserTasks(array $filters = [], int $taskPerPage = 10)
    {
        $query = Task::query();
        // if filter applied
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }
        return $query->orderBy("id", "desc")->paginate($taskPerPage)->withQueryString();
    }

    public function getTaskById($id)
    {
        return Task::findOrFail($id);
    }

    public function createTask(array $data)
    {
        return Task::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'status' => $data['status'] ?? 'pending',
            'user_id' => Auth::id(),
        ]);
    }

    public function updateTask($task, array $data)
    {
        if ($data['status'] == "completed") {
            if (empty($data['completed_at']))
                $data['completed_at'] = now();
        } else
            $task->completed_at = $data['completed_at'] = null;

        $task->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'status' => $data['status'] ?? $task->status,
            'completed_at' => $data['completed_at'] ?? $task->completed_at,
        ]);
        return $task;
    }
    // delete task By Id
    public function deleteTask($task)
    {
        $task->delete();
        return true;
    }

    public function markTaskAsDone($task)
    {
        $task->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
        return $task;
    }

    public function getUserTaskCountByStatus(int $userId)
    {
        $query = Task::query();
        $query->where('user_id', $userId);
        // Group by status and count
        $tasksWithCounts = $query->groupBy('status')->select('status', \DB::raw('count(*) as count'))->get();
        return $tasksWithCounts;
    }
}
