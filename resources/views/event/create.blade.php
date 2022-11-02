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
                <label for="kategori_id">Kategori event</label>
                <select name="kategori_id" id="kategori_id" class="form-control">
                  <option value="">Pilih Kategori</option> 
                  @foreach($itemkategori as $kategori)
                  <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="kode_event">Kode event</label>
                <input type="text" name="kode_event" id="kode_event" class="form-control">
              </div>
              <div class="form-group">
                <label for="nama_event">Nama event</label>
                <input type="text" name="nama_event" id="nama_event" class="form-control">
              </div>
              <div class="form-group">
                <label for="slug_event">Slug event</label>
                <input type="text" name="slug_event" id="slug_event" class="form-control">
              </div>
              <div class="form-group">
                <label for="deskripsi_event">Deskripsi</label>
                <textarea name="deskripsi_event" id="deskripsi_event" cols="30" rows="5" class="form-control"></textarea>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="qty">Qty</label>
                    <input type="text" name="qty" id="qty" class="form-control">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" name="satuan" id="satuan" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" class="form-control">
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