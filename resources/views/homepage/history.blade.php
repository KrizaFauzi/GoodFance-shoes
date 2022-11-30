@extends('layouts.template')
@section('content')
<style>
    .contain{
        min-height: 75vh;
    }
    .top{
        top: 6px;
        right: 6px;
    }
</style>
<div class="contain container mt-3">
    <div class="d-flex justify-content-center">
        <h4 class="fw-bolder">History Pembelian</h4>
      </div>
    <div class="row row-cols-1 row-cols-lg-5 g-2 g-lg-3 ms-2 ms-lg-2 ms-md-2 ms-xl-2">
        @foreach($checkout as $produk)
        <div class="col">
          <div class="card position-relative" style="height: 415px;">
            <div class="position-absolute top">
              
              <form action="{{ route('wishlist.store') }}" method="post">
                @csrf
                  <input type="hidden" name="produk_id" value={{ $produk->id }}>
                  <button type="submit" class="btn btn-sm btn-outline-secondary">
                    @auth
                      @if($produk->cart->produk->wish(Auth::user()->id, $produk->id))
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
              @if ($produk->cart->produk->foto)
                <img src="{{ Storage::url($produk->cart->produk->foto) }}" class="card-img-top" style="height: 150px; width: 100%;" alt="...">
              @else
                <img src="{{ asset('images/NoImage2.jpg') }}" class="card-img-top" style="height: 150px; width: 100%;" alt="...">
              @endif
            </div>
            <div class="card-body">
              <div>
                @if(isset($produk->cart->produk->user->toko->nama_toko))
                  <a class="text-decoration-none fw-semibold text-dark" href="{{ route('homepage.toko', $produk->cart->produk->user_id) }}">{{ $produk->cart->produk->user->toko->nama_toko }}</a>
                @else
                  <p class="fw-semibold text-dark">{{ $produk->cart->produk->user->name }}</p>
                @endif
              </div>
              <div>
                <p class="card-text txt">{{ $produk->nama_produk }}</p>
              </div>
                <div>
                  <p class="card-text fw-bold">Harga</p>
                </div>
                <div>
                  <span>Rp. {{ number_format($produk->harga) }}</span>
                </div>
              <div>
                @if ($produk->cart->produk->rating)
                  @for ($x = 0; $x < $produk->cart->produk->rating->avg('rating'); $x++)
                    <i class="fa-solid fa-star text-warning"></i>
                  @endfor
                @endif
              </div>
            </div>
            <form action="{{ route('cart.store') }}" method="POST" class="mx-3" style="display: inline-block;">
                @csrf
                <input type="hidden" name="produk_id" value={{$produk->cart->produk->id}}>
                <input type="hidden" name="seller_id" value={{$produk->user->id}}>
                <input type="hidden" name="qty" value="1">
                @if (isset($produk->cart->produk->promoted_produk))
                  <input type="hidden" name="harga" value="{{ $produk->cart->produk->promoted_produk->harga_akhir }}">
                @else
                  <input type="hidden" name="harga" value="{{ $produk->cart->produk->harga }}">
                @endif
                <button  class="btn btn-outline-dark btn-sm mb-2" type="submit" style=" width:100%;">
                Beli Lagi
                </button>
            </form>
            <a href="{{ route('rating.rate', $produk->cart->produk->slug_produk) }}" type="button" class="btn btn-outline-warning btn-sm mb-2 mx-3"> <span class="text-dark">Beri Rating</span> <i class="fa-solid fa-star text-warning"></i></a>
          </div>
        </div>
        @endforeach
      </div>
</div>
@endsection