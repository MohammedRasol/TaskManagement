@extends('layouts.auth')

@section('title', 'Register')

@section('form-title')
    Create a new account
@endsection

@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="row gy-2 overflow-hidden">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           id="name"
                           placeholder="John Doe"
                           value="{{ old('name') }}"
                           required>
                    <label for="name" class="form-label">Name</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           id="email"
                           placeholder="name@example.com"
                           value="{{ old('email') }}"
                           required>
                    <label for="email" class="form-label">Email</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password"
                           id="password"
                           placeholder="Password"
                           required>
                    <label for="password" class="form-label">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="password"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation"
                           id="password_confirmation"
                           placeholder="Confirm Password"
                           required>
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="d-grid my-3">
                    <button class="btn btn-primary btn-lg" type="submit">Sign up</button>
                </div>
            </div>
            <div class="col-12">
                <p class="m-0 text-secondary text-center">
                    Already have an account?
                    <a href="{{ route('login') }}"
                       class="link-primary text-decoration-none">Sign in</a>
                </p>
            </div>
        </div>
    </form>
@endsection