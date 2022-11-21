@extends('layouts.template')
@section('content')
<div class="container mt-3" style="min-height: 74vh">
  <div class="row">
    <div class="col">
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
      <div class="row mb-2">
        <div class="col col-12 mb-2">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <span>Item</span>
              <a href="{{ route('cart.index') }}">Kembali</a>
            </div>
            <div class="card-body">
              <table class="table table-stripped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($itemcart as $detail)
                  <tr>
                    <td>
                    {{ $no++ }}
                    </td>
                    <td>
                    {{ $detail->CartDetail->nama_produk }}
                    <br />
                    {{ $detail->produk->kode_produk }}
                    </td>
                    <td>
                    {{ number_format($detail->CartDetail->harga) }}
                    </td>
                    <td>
                    @if (isset($detail->produk->promoted_produk->promo))
                      {{ number_format($detail->produk->promoted_produk->promo->diskon_persen) }}%
                    @else
                      0
                    @endif
                    </td>
                    <td>
                    {{ number_format($detail->CartDetail->qty) }}
                    </td>
                    <td>
                    {{ number_format($detail->CartDetail->total) }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col col-12">
          <div class="card">
            <div class="card-header">Alamat Pengiriman</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-stripped">
                  <thead>
                    <tr>
                      <th>Nama Penerima</th>
                      <th>Alamat</th>
                      <th>No tlp</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($itemalamatpengiriman)
                    <tr>
                      <td>
                        {{ $itemalamatpengiriman->nama_penerima }}
                      </td>
                      <td>
                        {{ $itemalamatpengiriman->alamat }}<br />
                        {{ $itemalamatpengiriman->kelurahan}}, {{ $itemalamatpengiriman->kecamatan}}<br />
                        {{ $itemalamatpengiriman->kota}}, {{ $itemalamatpengiriman->provinsi}} - {{ $itemalamatpengiriman->kodepos}}
                      </td>
                      <td>
                        {{ $itemalamatpengiriman->no_tlp }}
                      </td>
                      <td>
                        <a href="{{ route('alamatpengiriman.index') }}" class="btn btn-success btn-sm">
                          Ubah Alamat
                        </a>                        
                      </td>
                    </tr>
                  @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <a href="{{ route('alamatpengiriman.index') }}" class="btn btn-sm btn-primary">
                Tambah Alamat
              </a>
              <form action="{{ route('checkout.store') }}" method="post">
                @csrf
                @if($cart2)
                  @if ($itemalamatpengiriman)
                  <input type="hidden" name="alamat" value={{ $itemalamatpengiriman->id }}>
                  @endif
                  <input type="hidden" name="cart" value={{ $cart2->id }}>
                  <input type="hidden" name="param" value="checkout">
                @endif
                <button type="submit" class="btn btn-sm btn-primary">Checkout</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
  </div>
</div>
@endsection