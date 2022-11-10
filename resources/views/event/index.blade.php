@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
  <!-- table produk -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{ $title }}</h4>
          <div class="card-tools">
            <a href="{{ route('event.create') }}" class="btn btn-sm btn-primary">
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
                  <th>Nama Event</th>
                  <th>Tanggal Awal</th>
                  <th>Tanggal Akhir</th>
                  <th>Jumlah User Terdaftar</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($itemevent as $event)
                <tr>
                  <td>
                  {{ ++$no }}
                  </td>
                  <td>
                  {{ $event->nama_event }}
                  </td>
                  <td>
                  {{ $event->tanggal_awal }}
                  </td>
                  <td>
                    {{ $event->tanggal_akhir }}
                  </td>
                  @if (isset($event->userDaftar->event_id))
                    @if($event->userDaftar->event_id == $event->id)
                        <td>
                            {{ number_format(count($userCount)) }}
                        </td>
                    @endif
                  @else
                    <td>
                        0
                    </td>
                  @endif
                  <td>
                    <a href="{{ route('event.show', $event->id) }}" class="btn btn-sm btn-primary mr-2 mb-2">
                      Detail
                    </a>
                    <a href="{{ route('event.edit', $event->id) }}" class="btn btn-sm btn-primary mr-2 mb-2">
                      Edit
                    </a>
                    <form action="{{ route('event.destroy', $event->id) }}" method="post" style="display:inline;" id="hapus_event">
                      @csrf
                      {{ method_field('delete') }}
                      <button type="submit" class="btn btn-sm btn-danger mb-2">
                        Hapus
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