@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Form Produk</h3>
          <div class="card-tools">
            <a href="{{ route('promo.index') }}" class="btn btn-sm btn-danger">
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
          <form action="{{ route('promo.update', $itempromo->id) }}" method="post">
            {{ method_field('patch') }}
            @csrf            
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nama_promo">Nama Promo</label>
                  <input type="text" name="nama_promo" id="nama_promo" class="form-control" value={{ $itempromo->nama_promo }}>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="diskon_persen">Diskon Persen</label>
                  <input type="text" name="diskon_persen" id="diskon_persen"  class="form-control" value={{ $itempromo->diskon_persen }}>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Update</button>
              <button type="reset" class="btn btn-warning">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection