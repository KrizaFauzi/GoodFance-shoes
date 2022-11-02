@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col col-lg-6 col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form Produk</h3>
            <div class="card-tools">
              <a href="{{ route('promoted_produk.index') }}" class="btn btn-sm btn-danger">
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
            <form action="{{ route('promoted_produk.update', $produk->id) }}" method="post">
              {{ method_field('patch') }}
              @csrf
              <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="produk_id">Produk</label>
                        <select name="produk_id" id="produk_id" class="form-control">
                            <option value="{{ $produk->produkId }}">{{ $produk->nama_produk }} - {{ $produk->kode_produk }}</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="promo_id">Promo</label>
                            <select name="promo_id" id="promo_id" class="form-control">
                                <option value="{{ $produk->promoId }}">{{ $produk->nama_promo }} - {{ $produk->diskon_persen }}%</option>
                                @foreach($itempromo as $promo)
                                <option value="{{ $promo->id }}">{{ $promo->nama_promo }} - {{ $promo->diskon_persen }}%</option>            
                                @endforeach
                            </select>
                         </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="diskon_nominal">Diskon Nominal</label>
                        <input type="text" name="diskon_nominal" id="diskon_nominal" class="form-control" value={{ $produk->diskon_nominal }}>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="harga_awal">Harga Awal</label>
                        <input type="text" name="harga_awal" id="harga_awal" class="form-control" value={{ $produk->harga_awal }}>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="harga_akhir">Harga Akhir</label>
                        <input type="text" name="harga_akhir" id="harga_akhir" class="form-control" value={{ $produk->harga_akhir }}>
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
  <script>
      // cari nominal diskon
      $('#diskon_persen').on('keyup', function() {
        var harga_awal = $('#harga_awal').val();
        var diskon_persen = $('#diskon_persen').val();
        var diskon_nominal = diskon_persen / 100 * harga_awal;
        var harga_akhir = harga_awal - diskon_nominal;
        $('#diskon_nominal').val(diskon_nominal);
        $('#harga_akhir').val(harga_akhir);
      })
      // load produk detail
      $('#promo_id').on('change', function() {
        var idproduk = $('#produk_id').val();
        var idpromo = $('#promo_id').val();
        $.ajax({
          url: '{{ URL::to('seller/loadprodukasync') }}/'+ idproduk + '/'+ idpromo,
          type: 'get',
          dataType: 'json',
          success: function (data,status) {
            if (status == 'success') {
              $('#harga_awal').val(data.itemproduk.harga);
              var diskon = data.itempromo.diskon_persen;
              var harga_awal = $('#harga_awal').val();
              var diskon_persen = diskon;
              var diskon_nominal = diskon_persen / 100 * harga_awal;
              var harga_akhir = harga_awal - diskon_nominal;
              $('#diskon_nominal').val(diskon_nominal);
              $('#harga_akhir').val(harga_akhir);
            }
          },
          error : function(x,t,m) {
          }
        })
      })
  </script>
@endsection