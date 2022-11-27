@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Warna</h3>
          <div class="card-tools">
            <a href="{{ route('produk.index') }}" class="btn btn-sm btn-danger">
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
          <form action="{{ route('warna.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="warna">Tambahkan Warna untuk produk</label>
                  <input name="warna" id="warna" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="seller_id" value="{{ $itemproduk->user->id }}">
              <input type="hidden" name="produk_id" value="{{ $itemproduk->id }}">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="reset" class="btn btn-warning">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ukuran</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('ukuran.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="ukuran">Tambahkan Ukuran untuk produk</label>
                  <input name="ukuran" id="ukuran" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="seller_id" value="{{ $itemproduk->user->id }}">
              <input type="hidden" name="produk_id" value="{{ $itemproduk->id }}">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="reset" class="btn btn-warning">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Table Warna</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Warna</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($warna as $warna)
                  <tr>
                    <td>
                      {{ $warna->warna }}
                    </td>
                    <td>
                    <form action="{{ route('warna.destroy', $warna->id) }}" method="post" style="display:inline;">
                      @csrf
                      {{ method_field('delete') }}
                      <button type="submit" class="btn btn-sm btn-danger mb-2">
                        Hapus
                      </button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td></td>
                  <td></td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Table Ukuran</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Ukuran</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($ukuran as $ukuran)
                  <tr>
                    <td>
                      {{ $ukuran->ukuran }}
                    </td>
                    <td>
                    <form action="{{ route('ukuran.destroy', $ukuran->id) }}" method="post" style="display:inline;">
                      @csrf
                      {{ method_field('delete') }}
                      <button type="submit" class="btn btn-sm btn-danger mb-2">
                        Hapus
                      </button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td></td>
                  <td></td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col col-lg-4 col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <td>Kode Produk</td>
                <td>
                  {{ $itemproduk->kode_produk }}
                </td>
              </tr>
              <tr>
                <td>Nama Produk</td>
                <td>
                {{ $itemproduk->nama_produk }}
                </td>
              </tr>
              <tr>
                <td>Qty</td>
                <td>
                {{ $itemproduk->qty }} {{ $itemproduk->satuan }}
                </td>
              </tr>
              <tr>
                <td>Harga</td>
                <td>
                  Rp. {{ number_format($itemproduk->harga, 2) }}
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col col-lg-8 col-md-8">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Foto Produk</h3>
        </div>
        <div class="card-body">
          <form action="{{ url('/seller/produkimage') }}" method="post" enctype="multipart/form-data" class="form-inline">
            @csrf
            <div class="form-group">
              <input type="file" name="image" id="image">
              <input type="hidden" name="produk_id" value={{ $itemproduk->id }}>
            </div>
            <div class="form-group">
              <button class="btn btn-primary">Upload</button>
            </div>
          </form>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col mb-2">
            </div>
          </div>
          <div class="row">
            @foreach($produkImage as $image)
            <div class="col-md-3 mb-2">
              <img src="{{ \Storage::url($image->foto) }}" alt="image" class="img-thumbnail mb-2">
              <form action="{{ url('/seller/produkimage/'.$image->produk_id) }}" method="post" style="display:inline;">
                @csrf
                {{ method_field('delete') }}
                <button type="submit" class="btn btn-sm btn-danger mb-2">
                  Hapus
                </button>                    
              </form>
            </div>
            @endforeach
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection