@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Daftar Event') }}</div>

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
                    <form method="POST" action="{{ route('register') }}">
                        <div class="row">
                            <div class="col">
                                @csrf
                                <div>
                                    <h2>Daftarkan Akun ke event dengan data berikut</h2>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <p class="form-control">{{  Auth::user()->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <p class="form-control">{{  Auth::user()->email }}</p>
                                </div>
                                <div>
                                    <input class="invisible" type="text" value="{{ Auth::user()->id }}">
                                    <input class="invisible" type="text" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-primary mb-4">Daftar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection