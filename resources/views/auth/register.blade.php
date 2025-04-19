{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

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

    <!-- Left Side: Image -->
    <div class="image-side">
    <img src="{{ asset('img/sign-up.jpg') }}" alt="Sign Up">
    </div>
      
      <!-- Right Side: Form -->
      <div class="form-side mt-4">
        <h2>{{ __('Register') }}</h2>
        <p>Alreay have an account? <a href="{{route('login')}}" class="text-primary">Log in</a></p>

        <form method="POST" action="{{ route('register') }}"">
            @csrf

          <div class="mb-2">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" placeholder="Jhon Due..">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="mb-2">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="hello@gmail.com..">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="mb-2">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off" placeholder="Try strong pass..">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="mb-2">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off" placeholder="Re-type password..">
          </div>

          <input type="submit" class="btn btn-login" value="Registation">

          
        </form>
      </div>
  
  
    </div>
</div>
@endsection

