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
            <a href="{{ route('produk.create') }}" class="btn btn-sm btn-primary">
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
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Event Terbaru</h4>
                </div>
                @forelse ($event as $events)
                  <div class="card-body">
                    <a href="/seller/daftar_event/{{ $events->event->id }}">
                      <div class="card text-white bg-info mb-3" >
                        <h4 class="card-header">{{ $events->event->nama_event }}</h4>
                        <div class="card-body">
                          <h5 class="card-title">Berakhir pada {{ $events->event->tanggal_akhir }}</h5>
                          <p class="card-text">{{ $events->event->deskripsi }}</p>
                        </div>
                      </div>
                    </a>
                  </div>
                  @empty
                  <div class="container mt-2">
                    <div class="alert alert-info" role="alert">
                      Tidak mengikuti event
                     </div>
                  </div>
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection