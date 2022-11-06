@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col col-lg col-md">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $title }}</h3>
          <div class="card-tools">
            <a href="{{ route('event.index') }}" class="btn btn-sm btn-danger">
              Tutup
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <td>Nama Event</td>
                <td>
                  {{ $event->nama_event }}
                </td>
              </tr>
              <tr>
                <td>Slug Event</td>
                <td>
                {{ $event->slug_event }}
                </td>
              </tr>
              <tr>
                <td>Deskripsi Event</td>
                <td>
                {{ $event->deskripsi }}
                </td>
              </tr>
              <tr>
                <td>Tanggal</td>
                <td>
                {{ $event->tanggal_awal }} - {{ $event->tanggal_akhir }}
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection