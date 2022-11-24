@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col col-lg col-md">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
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
            <form action="{{ route('toko.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="nama_toko">Nama Toko</label>
                    <input type="text" name="nama_toko" id="nama_toko" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="waktu_buka">Waktu Buka</label>
                    <input type="time" name="waktu_buka" id="waktu_buka" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="waktu_tutup">Waktu Tutup</label>
                    <input type="time" name="waktu_tutup" id="waktu_tutup" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="photo_profile">Photo Profile</label>
                    <p><Span class="fw-semibold">NOTE : </Span> Direkomendasikan foto berukuran 500 x 500</p>
                    <input type="file" name="photo_profile" id="photo_profile" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="background">Background</label>
                    <p><Span class="fw-semibold">NOTE : </Span> Direkomendasikan foto berukuran 1223 x 300</p>
                    <input type="file" name="background" id="background" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <input type="hidden" name="seller_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-warning">Reset</button>
              </div>
            </form>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nama Toko</th>
                    <th>Waktu</th>
                    <th>Action </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  @if (isset($toko->id))
                    <td>
                      {{ $toko->nama_toko }}
                    </td>
                    <td>
                        {{ $toko->waktu_buka }} - {{ $toko->waktu_tutup }}
                    </td>
                    <td>
                      <form action="{{ route('toko.destroy', $toko->id) }}" method="post" style="display:inline;">
                        @csrf
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-sm btn-danger mb-2">
                          Hapus
                        </button>
                      </form>
                    </td>
                  @endif
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection