@extends('admin.layouts.dashboard')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col col-lg col-md">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $title }}</h3>
          <div class="card-tools">
            <a href="{{ route('event.index') }}" class="btn btn-sm btn-danger">
              Tutup
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <td>Nama Event</td>
                <td>
                  {{ $event->nama_event }}
                </td>
              </tr>
              <tr>
                <td>Slug Event</td>
                <td>
                {{ $event->slug_event }}
                </td>
              </tr>
              <tr>
                <td>Deskripsi Event</td>
                <td>
                {{ $event->deskripsi }}
                </td>
              </tr>
              <tr>
                <td>Tanggal</td>
                <td>
                {{ $event->tanggal_awal }} - {{ $event->tanggal_akhir }}
                </td>
              </tr>
            </table>
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
          <form action="{{ route('promos.store', $event->id) }}" method="post">
            @csrf
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nama_promo">Nama Promo</label>
                  <input type="text" name="nama_promo" id="nama_promo" class="form-control" value={{ old('kode_promo') }}>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="diskon_persen">Diskon Persen</label>
                  <input type="text" name="diskon_persen" id="diskon_persen" class="form-control" value={{ old('diskon_persen') }}>
                </div>
              </div>
            </div>
            <div class="form-group">
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
                  <th width="50px">No</th>
                  <th>Nama Promo</th>
                  <th>Promo persen</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($itempromo as $promo)
                <tr>
                  <td>
                  {{ ++$no }}
                  </td>
                  <td>
                  {{ $promo->nama_promo }}
                  </td>
                  <td>
                  {{ $promo->diskon_persen }}
                  </td>
                  <td>
                    <form action="{{ route('promos.destroy', $promo->id) }}" method="post" style="display:inline;">
                      @csrf
                      {{ method_field('delete') }}
                      <button type="submit" class="btn btn-sm btn-danger mb-2">
                        Hapus
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection