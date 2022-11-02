@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <!-- table produk -->
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Produk</h4>
            <div class="card-tools">
              <a href="{{ route('promoted_produk.create') }}" class="btn btn-sm btn-primary">
                Baru
              </a>
            </div>
          </div>
          <div class="card-body">
            <form action="#">
              <div class="row">
                <div class="col">
                  <input type="text" name="keyword" id="keyword" class="form-control" placeholder="ketik keyword disini">
                </div>
                <div class="col-auto">
                  <button class="btn btn-primary">
                    Cari
                  </button>
                </div>
              </div>
            </form>
          </div>
          <div class="card-body">
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
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="50px">No</th>
                    <th>Nama Produk</th>
                    <th>Nama Promo</th>
                    <th>Diskon Persen</th>
                    <th>Diskon Nominal</th>
                    <th>Harga Awal</th>       
                    <th>Harga Akhir</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 @forelse( $itemproduk as $produk )
                  <tr>
                    <td>
                        {{ ++$no }}
                    </td>
                    <td>
                        {{ $produk->nama_produk }}
                    </td>
                    <td>
                        {{ $produk->nama_promo }}
                    </td>
                    <td>
                        {{ $produk->diskon_persen }}%
                    </td>
                    <td>
                        {{ number_format($produk->diskon_nominal) }}
                    </td>
                    <td>
                        {{ number_format($produk->harga_awal) }}
                    </td>
                    <td>
                        {{ number_format($produk->harga_akhir) }}
                    </td>
                    <td>
                      <a href="{{ route('promoted_produk.edit', $produk->id) }}" class="btn btn-sm btn-primary mr-2 mb-2">
                        Edit
                      </a>
                      <form action="{{ route('promoted_produk.destroy', $produk->id ) }}" method="post" style="display:inline;">
                        @csrf
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-sm btn-danger mb-2">
                          Hapus
                        </button>                    
                      </form>
                    </td>
                  </tr>
                @empty
                <div> Data Kosong </div>
                @endforelse
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection