@extends('layouts.dashboard')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="mb-4">Edit Task</h2>

            <!-- Display General Form Errors (if any) -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $task->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="canceled" {{ old('status', $task->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Optional: Add user_id if needed -->
                @if (isset($users))
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Assign to User</label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <!-- Optional: Add completed_at if needed -->
                {{-- <div class="mb-3">
                    <label for="completed_at" class="form-label">Completed At</label>
                    <input type="datetime-local" class="form-control @error('completed_at') is-invalid @enderror"
                     id="completed_at" name="completed_at" value="{{ old('completed_at', $task->completed_at ? $task->completed_at->format('Y-m-d\TH:i') : '') }}">
                    @error('completed_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <button type="submit" class="btn btn-primary">Update Task</button>
            </form>
        </div>
    </div>
@endsection