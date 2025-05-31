@extends('layouts.auth')

@section('title', 'Login')

@section('form-title')
    Sign in to your account
@endsection

@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="row gy-2 overflow-hidden">
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
                <div class="d-flex gap-2 justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               value="1"
                               name="rememberMe"
                               id="rememberMe"
                               {{ old('rememberMe') ? 'checked' : '' }}>
                        <label class="form-check-label text-secondary" for="rememberMe">
                            Keep me logged in
                        </label>
                    </div>
                    <a href="#" onclick="alert('On production ;)')"
                       class="link-primary text-decoration-none">
                        Forgot password?
                    </a>
                </div>
            </div>
            <div class="col-12">
                <div class="d-grid my-3">
                    <button class="btn btn-primary btn-lg" type="submit">Log in</button>
                </div>
            </div>
            <div class="col-12">
                <p class="m-0 text-secondary text-center">
                    Don't have an account?
                    <a href="{{ route('register') }}"
                       class="link-primary text-decoration-none">Sign up</a>
                </p>
            </div>
        </div>
    </form>
@endsection