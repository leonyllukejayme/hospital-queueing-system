@extends('layouts.layout')

@section('title','Sign-up')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-4 d-grid gap-2 bg-white p-4 rounded-2">
            <h3 class="text-center">Sign Up</h3>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
            @endif

            @if (session()->has('error'))
                <p class="alert alert-danger">{{ session('error') }}</p>
            @endif
            @if (session()->has('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
            @endif

            <form class="d-flex flex-column gap-2" action="{{ route('signup.post') }}" method="POST" id="loginForm">
                @csrf
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                <a href="/">Log in</a>
            </form>
        </div>
    </div>
</div>
@endsection
