@extends('layouts.dashboard')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <h1 class="mb-4">Welcome, <span class="text-primary">{{ Auth::user()->name }}</span></h1>
        <!-- Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-users me-2"></i> Total</h5>
                        <p class="card-text display-4">{{ $total }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-check"></i></i> Completed</h5>
                        <p class="card-text display-4">{{ $completed }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-hourglass-half"></i> Pending</h5>
                        <p class="card-text display-4">{{ $pending }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-hourglass-half"></i> Canceled</h5>
                        <p class="card-text display-4">{{ $canceled }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table  table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col" class="d-table-cell d-md-none">Description</th>
                            <th scope="col">Status</th>
                            {{-- <th scope="col">Options</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentTasks as $task)
                            <tr id="task-{{ $task->id }}">
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->title }}</td>
                                <td class="d-table-cell d-md-none">
                                    <button class="dropdown-item text-info"
                                        onclick="showTask('{{ $task->id }}','{{ $task->title }}','{{ $task->description }}','{{ $task->status }}')">
                                        <i class="fa-solid fa-eye"></i> View Task
                                    </button>
                                </td>


                                <td>
                                    <span id="task-status-{{ $task->id }}"
                                        class="badge {{ $task->status === 'pending' ? 'bg-warning' : ($task->status === 'completed' ? 'bg-success' : 'bg-secondary') }}">
                                        {{ $task->status }}
                                    </span>
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
        </div>
    </div>
@endsection
