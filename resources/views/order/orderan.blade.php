@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
  <!-- table produk -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Orderan</h4>
        </div>
        <div class="card-body">
          <form action="#">
            <div class="row">
              <div class="col">
                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="ketik keyword disini">
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
                      Pesanan diterima
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