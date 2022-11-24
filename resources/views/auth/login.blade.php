@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-warning">{{ $error }}</div>
                    @endforeach
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-warning">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" required class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="password">Password</label>
                                <a href="{{ route('password.request') }}" class="text-decoration-none">Forget Password?</a>
                            </div>     
                            <input type="password" name="password" id="password" required class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary mb-4">Login</button>
                            <p>Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Sign up</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection