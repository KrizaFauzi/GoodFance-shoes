@extends('layouts.template')
@section('content')
<style>
.back:hover {
    color: #682773;
    cursor: pointer
}
.labels {
    font-size: 11px
}
.contain{
    min-height: 70vh;
}
</style>
    <div class="contain container rounded bg-white mt-4 mb-4 pt-3 border">
        <h4 class="fw-bold ms-1">Profil Saya</h4>
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="mt-5 rounded-circle" width="150px" src="{{ asset('img/unknownwn.png') }}">
                    <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                    <span class="text-black-50">{{ Auth::user()->email }}</span><span> </span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile</h4>
                    </div>
                    <form>
                        @csrf
                        <div class="form-group row mt-2">
                            <div class="col-md-12">
                                <label class="labels fs-6">Nama Lengkap</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" readonly>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="form-group col-md-12">
                                <label class="labels fs-6">Nomor Telepon</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" readonly>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 mt-2">
                                <label class="labels fs-6">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection