@extends('layouts.dashboard')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h1">{{ auth()->user()->name ?? 'User' }} Tasks</h1>
            <a class="btn btn-primary" href="/tasks/create">Add New Task</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Filter and Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 d-none d-md-flex  ">Tasks </h5>
                <div class="filter ">
                    <form action="" method="GET">
                        <div class="input-group   ">
                            <div class="">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">All Statuses</option>
                                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="canceled" {{ request('status') === 'canceled' ? 'selected' : '' }}>
                                        Canceled
                                    </option>
                                </select>
                            </div>
                            <div class="margin-left-10">
                                <select name="perPage" class="form-select" onchange="this.form.submit()">
                                    <option value="10" {{ request('perPage') === '10' ? 'selected' : '' }}> 10 per-page
                                    </option>
                                    <option value="25" {{ request('perPage') === '25' ? 'selected' : '' }}> 25 per-page
                                    </option>
                                    <option value="50" {{ request('perPage') === '50' ? 'selected' : '' }}> 50 per-page
                                    </option>
                                    <option value="100" {{ request('perPage') === '100' ? 'selected' : '' }}> 100
                                        per-page </option>
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="card-body" >
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col" class="d-none d-md-table-cell">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr id="task-{{ $task->id }}">
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td class="d-none d-md-table-cell">{{ $task->description }}</td>
                                    <td>
                                        <span id="task-status-{{ $task->id }}"
                                            class="badge {{ $task->status === 'pending' ? 'bg-warning' : ($task->status === 'completed' ? 'bg-success' : 'bg-secondary') }}">
                                            {{ $task->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                id="taskActions{{ $task->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="taskActions{{ $task->id }}">
                                                @if ($task->status === 'pending')
                                                    <li>
                                                        <button class="dropdown-item"
                                                            onclick="markDone('{{ $task->id }}', this)">
                                                            <i class="fa-solid fa-check"></i> Mark Done
                                                        </button>
                                                    </li>
                                                @endif
                                                <li class="d-block d-md-none">
                                                    <button class="dropdown-item text-info"
                                                        onclick="showTask('{{ $task->id }}','{{ $task->title }}','{{ $task->description }}','{{ $task->status }}')">
                                                        <i class="fa-solid fa-eye"></i> View Task
                                                    </button>
                                                </li>
                                                <li>
                                                    <a href="/tasks/{{ $task->id }}/edit"
                                                        class="dropdown-item text-primary">
                                                        <i class="fa-solid fa-pen-to-square"></i> Edit Task
                                                    </a>
                                                </li>

                                                <li>
                                                    <button class="dropdown-item text-danger"
                                                        onclick="deleteTask('{{ $task->id }}')">
                                                        <i class="fa-solid fa-trash"></i> Delete Task
                                                    </button>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if (!count($tasks))
                                <tr>
                                    <td colspan="5" class="text-center text-secondary h1">
                                        No Tasks !
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
            </div>

            @if ($tasks->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $tasks->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

<script>

</script>
