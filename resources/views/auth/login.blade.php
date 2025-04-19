@extends('layouts.user')

@section('content')

<style>
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      min-height: 90vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
    }
    .login-box {
      background: #fff;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      border-radius: 10px;
      overflow: hidden;
      display: flex;
      max-width: 1000px;
      width: 100%;
    }
    .form-side {
      padding: 40px;
      width: 50%;
    }
    .form-side h2 {
      margin-bottom: 10px;
      font-weight: 600;
    }
    .form-side p {
      margin-bottom: 30px;
      color: #666;
    }
    .form-control {
      margin-bottom: 20px;
    }
    .form-check-label {
      margin-left: 5px;
    }
    .btn-login {
      background-color: #7b2cbf;
      color: white;
      width: 100%;
      padding: 10px;
    }
    .btn-login:hover {
      background-color: #5a189a;
    }
    .social-login {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }
    .social-login button {
      width: 48%;
    }
    .image-side {
      width: 50%;
      background: #f1f1ff;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .image-side img {
      max-width: 100%;
      height: auto;
    }
  </style>

<div class="login-container">
    <div class="login-box">
      
      <!-- Left Side: Form -->
      <div class="form-side mt-5">
        <h2>{{ __('Login') }}</h2>
        <p>Doesn't have an account yet? <a href="{{route('register')}}" class="text-primary">Sign Up</a></p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

          <div class="mb-2">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="hello@gmail.." autocomplete="off" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="mb-2">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Try Strong Pass...">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
          </div>

          <input type="submit" class="btn btn-login" value="LOGIN">

          
        </form>
      </div>
  
      <!-- Right Side: Image -->
      <div class="image-side">
        <img src="{{ asset('img/login.png') }}" alt="Login">
      </div>
  
    </div>
</div>
@endsection
