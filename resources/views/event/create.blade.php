@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col col-lg-6 col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form Event</h3>
            <div class="card-tools">
              <a href="{{ route('event.index') }}" class="btn btn-sm btn-danger">
                Tutup
              </a>
            </div>
          </div>
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
            <form action="{{ route('event.store') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="nama_event">Nama event</label>
                <input type="text" name="nama_event" id="nama_event" class="form-control">
              </div>
              <div class="form-group">
                <label for="slug_event">Slug event</label>
                <input type="text" name="slug_event" id="slug_event" class="form-control">
              </div>
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control"></textarea>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="tanggal_awal">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="tanggal_akhir">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-warning">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection