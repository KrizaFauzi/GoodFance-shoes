@extends('layouts.template')
@section('content')
<style>
  .contain{
    min-height: 76vh;
  }
  .ukuran{
    font-size: 1rem;
  }
</style>
<div class="contain container">
  <div class="row">
    <div class="col mt-4">
      <h1>Tentang Kami</h1>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      @if (isset($about))
        {!! $about->about !!}
      @endif
    </div>
  </div>
</div>
@endsection