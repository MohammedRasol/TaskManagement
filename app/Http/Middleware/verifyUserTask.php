<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class verifyUserTask
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the authenticated user
        $user = Auth::user();
        if (!$user) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'You must be logged in.'], 401);
            }
            return redirect()->route('login')->with('error', 'You must be logged in.');
        }

        $task = $request->route('task');
        if (!$task) {
            return $next($request);
        }
        if (!$task) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'Task not found.'], 404);
            }
            return redirect('/home')->with('error', 'Task not found.');
        }
        if ($task->user_id !== $user->id) {
            if ($request->ajax() || $request->wantsJson()) {

                return response()->json(['error' => 'You do not have permission to access this task.'], 403);
            }

            return redirect('/home')->with('error', 'You do not have permission to access this task.');
        }

        return $next($request);
    }
}
