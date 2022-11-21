@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-6 col-lg-3">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>{{ $pesanan }}</h3>

          <p>Pesanan masuk</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $produkCount }}</h3>

          <p>Produk</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $eventCount }}</h3>

          <p>Event yang diikuti</p>
        </div>
        <div class="icon">
          <i class="ion ion-calendar"></i>
        </div>
      </div>
    </div>

    <div class="col-6 col-lg-3">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $transaksi }}</h3>

          <p>Transaksi</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>
  </div>
  <!-- table produk baru -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Pesanan masuk</h4>
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
                  <th>Qty</th>
                  <th>Invoice</th>
                  <th>Tanggal Dipesan</th>
                  <th width="250px"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($orderan as $order)
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
                   {{ $order->created_at }}
                  </td>
                  <td>
                    <form action="{{ route('order.terima', $order->id) }}" method="post" style="display:inline;">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-success mb-2">
                        Terima Pesanan
                      </button>                    
                    </form>
                    <form action="{{ route('order.tolak', $order->id) }}" method="post" style="display:inline;">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-danger mb-2">
                        Tolak Pesanan
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