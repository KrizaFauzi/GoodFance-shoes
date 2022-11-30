@extends('layouts.template')
@section('content')
<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SET_YOUR_CLIENT_KEY_HERE"></script>
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
            </div>
            <div class="card-body">
              <table class="table table-stripped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Warna</th>
                    <th>Ukuran</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($checkout as $checkout)
                  <tr>
                    <td>
                    {{ $no++ }}
                    </td>
                    <td>
                    {{ $checkout->cart->CartDetail->nama_produk }}
                    <br />
                    {{ $checkout->cart->produk->kode_produk }}
                    </td>
                    <td>
                      {{ $checkout->cart->CartDetail->warna }}
                    </td>
                    <td>
                      {{ $checkout->cart->CartDetail->ukuran }}
                    </td>
                    <td>
                    {{ number_format($checkout->cart->CartDetail->harga) }}
                    </td>
                    <td>
                    @if (isset($checkout->cart->produk->promoted_produk->promo))
                      {{ number_format($checkout->cart->produk->promoted_produk->promo->diskon_persen) }}%
                    @else
                      0
                    @endif
                    </td>
                    <td>
                    {{ number_format($checkout->cart->CartDetail->qty) }}
                    </td>
                    <td>
                    {{ number_format($checkout->cart->CartDetail->total) }}
                    </td>
                  </tr>
                  @endforeach
                  <tr>
                    <td>Total </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ number_format($checkout->cart->qtyTotalCheckout($order->id, Auth::user()->id)) }}</td>
                    <td>{{ number_format($checkout->cart->totalCheckout($order->id, Auth::user()->id)) }}</td>
                  </tr>
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
                  @if($checkout->pengiriman)
                    <tr>
                      <td>
                        {{ $checkout->pengiriman->nama_penerima }}
                      </td>
                      <td>
                        {{ $checkout->pengiriman->alamat }}<br />
                        {{ $checkout->pengiriman->kelurahan}}, {{ $checkout->pengiriman->kecamatan}}<br />
                        {{ $checkout->pengiriman->kota}}, {{ $checkout->pengiriman->provinsi}} - {{ $checkout->pengiriman->kodepos}}
                      </td>
                      <td>
                        {{ $checkout->pengiriman->no_tlp }}
                      </td>
                    </tr>
                  @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <a href="" class="btn btn-danger btn-sm">Batalkan</a>
              <button type="submit" id="pay-button" class="btn btn-sm btn-primary">Pay</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<form id="payying" action="{{ Route('order.payying', $order->id) }}" method="post">
@csrf
<input type="hidden" name="param" value="pay">
</form>
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    var payForm = document.getElementById('payying');
    payButton.addEventListener('click', function () {
      window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
          alert("payment success!");
          payForm.submit();
        },
        onPending: function(result){
          alert("wating your payment!");
        },
        onError: function(result){
          alert("payment failed!");
        },
        onClose: function(){
          alert('you closed the popup without finishing the payment');
        }
      })
    });
  </script>
@endsection