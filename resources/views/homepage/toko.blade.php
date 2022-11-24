@extends('layouts.template')
@section('content')
<style>
    .contain{
        min-height: 46.7vh;
    }
    .image-contain{
        min-height: 38vh;
    }
    .bg{
        background-image: url("{{ Storage::url($toko->background) }}");
        background-attachment: inherit;
        background-position: center !important;;
        background-repeat: no-repeat;
        border-radius: 25px;
    }
    .rounding {
        min-height: 50vh;
        border-radius: 25px;
    }
    .top{
        top: 6px;
        right: 6px;
    }
</style>
<div class="contain container  mt-4 mb-4 p-4 ">
    <div class="bg-white rounding border border-dark">
        <div class=" bg image-contain border">
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <img class="m-4 rounded-circle" width="100px" src="{{ Storage::url($toko->photo_profile) }}">
                <div class="mt-5">
                    <h4 class="fw-semibold">{{ $toko->nama_toko }}</h4>
                    <h6 class="text-muted"><a class="text-decoration-none text-muted" target="_blank" href="https://api.whatsapp.com/send?phone={{ $toko->seller->phone }}">{{ $toko->seller->phone }}</a></h6>
                </div>
            </div>
            <div class="d-flex justify-content-start" >
                <div class="mt-5 text-center">
                    <h4 class="fw-semibold text-warning">{{ $toko->rating($toko->seller_id) }} <span><i class="fa-solid fa-star" ></i></span></h4>
                    <h6>Rating & Ulasan</h6>
                </div>
                <div class="my-4 ms-4" style="border-left:0.2px solid  rgb(79, 79, 79);"></div>
                <div class="mt-5 ms-4 text-center">
                    <h4 class="fw-semibold text-dark">{{ $toko->penjualan($toko->seller_id) }}</h4>
                    <h6>Total Penjualan</h6>
                </div>
                <div class="my-4 ms-4" style="border-left:0.2px solid  rgb(79, 79, 79);"></div>
                <div class="mx-4 mt-5 text-center" style="min-width: 100px">
                    <h4 class="fw-semibold">{{ $toko->waktu_buka }} - {{ $toko->waktu_tutup }}</h4>
                    <h6>Jam Operasi</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <div class="text-center mb-1">
            <h4 class="fw-bolder">Produk Yang DIjual</h4>
        </div>
        <div class="row row-cols-1 row-cols-lg-5 g-2 g-lg-3 ms-2 ms-lg-2 ms-md-2 ms-xl-2">
            @foreach($itemproduk as $produk)
                <div class="col">
                <div class="card position-relative" style="height: 415px;">
                    <div class="position-absolute top">
                    
                    <form action="{{ route('wishlist.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="produk_id" value={{ $produk->id }}>
                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                            @auth
                                @if($produk->wish(Auth::user()->id, $produk->id))
                                    <i class="fas fa-heart"></i>
                                @else
                                    <i class="far fa-heart"></i>
                                @endif
                            @endauth
                            @guest
                                <i class="far fa-heart"></i>
                            </button>
                            @endguest
                        </button>
                    </form>
                    </div>
                    <div style="height: 190px; max-width: 270px; display: flex; align-items: center; margin-left: auto; margin-right: auto;">
                    <img src="{{ Storage::url($produk->foto) }}" class="card-img-top" style="max-height: 190px; width: 100%;" alt="...">
                    </div>
                    <div class="card-body">
                    <div>
                        <p class="card-text txt">{{ $produk->nama_produk }}</p>
                    </div>
                    @if (isset($produk->promoted_produk->produk_id))
                        @if($produk->id == $produk->promoted_produk->produk_id)
                        <div>
                            <p class="card-text fw-bold">Harga Diskon</p>
                        </div>
                        <div>
                            <button type="button" class="btn btn-danger"
                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" disabled>
                            </button>
                            <span class="text-muted text-decoration-line-through">Rp. {{ number_format($produk->promoted_produk->harga_awal, 2) }}</span>
                        </div>
                        <div>
                            <span>Rp. {{ number_format($produk->promoted_produk->harga_akhir, 2) }}</span>
                        </div>                 
                        @endif
                    @else
                        <div>
                        <p class="card-text fw-bold">Harga</p>
                        </div>
                        <div>
                        <span>Rp. {{ number_format($produk->harga, 2) }}</span>
                        </div>
                    @endif
                    <div>
                        @if ($produk->rating)
                            @for ($x = 0; $x < (int) $produk->rating->avg('rating'); $x++)
                                <i class="fa-solid fa-star text-warning"></i>
                            @endfor
                        @endif
                    </div>
                    </div>
                    <form action="{{ route('cart.store') }}" method="POST" class="mx-3" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="produk_id" value={{$produk->id}}>
                        <input type="hidden" name="seller_id" value={{$produk->user->id}}>
                        <input type="hidden" name="qty" value="1">
                        @if (isset($produk->promoted_produk->produk_id))
                        <input type="hidden" name="harga" value="{{ $produk->promoted_produk->harga_akhir }}">
                        @else
                        <input type="hidden" name="harga" value="{{ $produk->harga }}">
                        @endif
                        <button  class="btn btn btn-outline-dark btn-sm mb-2" type="submit" style=" width:100%;">
                        Add To Cart
                        </button>
                    </form>
                    <a href="{{ URL::to('produk/'.$produk->slug_produk ) }}" type="button" class="btn btn-dark btn-sm mb-2 mx-3">Details</a>
                </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection