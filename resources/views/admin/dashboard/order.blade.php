@extends('admin.layouts.dashboard')
@section('content')
<div class="container-fluid">
    <!-- table kategori -->
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Pesanan Diproses</h4>
          </div>
          <div class="card-body">
            <p>Tunggu barang dari seller, jika barang sudah sampai silahkan lanjut di kirim</p>
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
            @if(count($errors) > 0)
              @foreach($errors->all() as $error)<div class="alert alert-warning">{{ $error }}</div>
              @endforeach
              @endif
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="50px">No</th>
                    <th>Nama Produk</th>
                    <th>Qty</th>
                    <th>Invoice</th>
                    <th>Tanggal Dipesan</th>
                    <th width="250px"></th>
                  </tr>
                </thead>
                <tbody>
                @foreach($order as $order)
                  <tr>
                    <td>
                    {{ ++$no }}
                    </td>
                    <td>
                    {{ $order->nama_produk }}
                    </td>
                    <td>
                    {{ $order->qty }}
                    </td>
                    <td>
                    {{ $order->invoice }}
                    </td>
                    <td>
                    {{ date_format($order->created_at, "Y/m/d") }}
                    </td>
                    <td>
                      <form action="{{ route('order.kirim', $order->id) }}" method="post" style="display:inline;">
                        @csrf
                          <button type="submit" class="btn btn-sm btn-success mb-2">
                            Kirim Pesanan
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