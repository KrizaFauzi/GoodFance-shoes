
@extends('layouts.template')
@section('content')

<style>
    .checked {
        color: orange;
    }

    .contain{
        min-height: 73vh;
    }
</style>

    <div class="contain container-fluid mt-4">
        <h2 class="text-center">Event {{ $event->nama_event }}</h2>
        <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
            @foreach ($promo as $promo)
                @foreach($promo->promoted_produk as $promoted_produk)
                    <div class="col">
                        <div class="card" style="height: 415px;">
                            <div style="height: 190px; max-width: 270px; display: flex; align-items: center; margin-left: auto; margin-right: auto;">
                                <img src="{{ Storage::url($promoted_produk->produk->foto) }}" class="card-img-top" style="max-height: 190px; width: 100%;" alt="...">
                            </div>
                            <div class="card-body">
                                <div>
                                    <p class="card-text">{{ $promoted_produk->produk->nama_produk }}</p>
                                </div>
                                    <div>
                                    <p class="card-text fw-bold">Harga Diskon</p>
                                    </div>
                                    <div>
                                    <button type="button" class="btn btn-danger"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" disabled>
                                    </button>
                                        <span class="text-muted text-decoration-line-through">Rp. {{ number_format($promoted_produk->harga_awal, 2) }}</span>
                                    </div>
                                    <div>
                                        <span>Rp. {{ number_format($promoted_produk->harga_akhir, 2) }}</span>
                                    </div>                 
                                <div>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <span>5.0</span>
                                </div>
                            </div>
                            <a type="button" class="btn btn btn-outline-dark btn-sm mb-2 mx-3">Add to cart</a>
                            <a href="{{ URL::to('produk/'.$promoted_produk->produk->slug_produk ) }}" type="button" class="btn btn-dark btn-sm mb-2 mx-3">Details</a>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection