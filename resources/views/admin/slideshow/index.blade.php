@extends('admin.layouts.dashboard')
@section('content')
<div class="container-fluid">
  <!-- table slideshow -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Slideshow</h4>
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
                  <th>Gambar</th>
                  <th>Title</th>
                  <th>Event</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($itemslideshow as $slide)
                <tr>
                  <td>
                  {{ ++$no }}
                  </td>
                  <td>
                    @if($slide->foto != null)
                    <img src="{{ \Storage::url($slide->foto) }}" alt="{{ $slide->caption_title }}" width='150px' class="img-thumbnail">
                    @endif
                  </td>
                  <td>
                  {{ $slide->caption_title }}
                  </td>
                  <td>
                  {{ $slide->event_id }}
                  </td>
                  <td>
                    <form action="{{ route('slideshow.destroy', $slide->id) }}" method="post" style="display:inline;">
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
            {{ $itemslideshow->links() }}
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <form action="{{ url('/admin/slideshow') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="foto">Foto</label>
                  <br />
                  <input type="file" name="image" id="image">
                </div>
                <div class="form-group">
                  <label for="caption_title">Title</label>
                  <input type="text" name="caption_title" class="form-control">
                </div>
                <div class="form-group">
                  <label for="event_id">Event</label>
                  <select name="event_id" id="event_id" class="form-control">
                      <option value="">Pilih Event</option>
                      @foreach($event as $event)
                        <option value="{{ $event->id }}">{{ $event->nama_event }}</option>            
                      @endforeach
                      <option value="0">Other Option</option>  
                  </select>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary">Upload</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection