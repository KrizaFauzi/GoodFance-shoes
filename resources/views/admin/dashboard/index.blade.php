@extends('admin.layouts.dashboard')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-6 col-lg-3">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>{{ $produkCount }}</h3>

          <p>Product</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $eventCount }}</h3>

          <p>Event</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $userCount }}</h3>

          <p>Member</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </div>

    <div class="col-6 col-lg-3">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $sellerCount }}</h3>

          <p>Seller</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </div>
  </div>
  <!-- table produk baru -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Event Terbaru</h4>
        </div>
        @forelse ($event as $events)
          <div class="card-body">
            <a href="/seller/daftar_event/{{ $events->id }}">
              <div class="card text-white bg-info mb-3" >
                <h4 class="card-header">{{ $events->nama_event }}</h4>
                <div class="card-body">
                  <h5 class="card-title">Berakhir pada {{ $events->tanggal_akhir }}</h5>
                  <p class="card-text">{!! $events->deskripsi !!}</p>
                </div>
              </div>
            </a>
          </div>
          @empty
          <div class="container mt-2">
            <div class="alert alert-info" role="alert">
              Tidak Ada Event terbaru
             </div>
          </div>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection