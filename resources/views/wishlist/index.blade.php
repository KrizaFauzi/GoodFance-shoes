
@extends('layouts.template')
@section('content')

<style>
    .checked {
        color: orange;
    }

    .contain{
        min-height: 73vh;
    }
    .top{
        top: 6px;
        right: 6px;
    }
</style>

<div class="contain container mb-4 mt-4">
  <h2 class="text-center">Wishlist</h2>
  <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
    @foreach ($itemwishlist as $wishlist)
    <div class="col">
        <div class="card position-relative" style="height: 415px;">
          <div class="position-absolute top">
            <form action="{{ route('wishlist.store') }}" method="post">
              @csrf
                <input type="hidden" name="produk_id" value={{ $wishlist->produk->id }}>
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                  @auth
                    @if($wishlist->produk->wish(Auth::user()->id, $wishlist->produk->id))
                        <i class="fas fa-heart"></i>
                    @else
                      <i class="far fa-heart"></i>
                    @endif
                  @endauth
                  @guest
                    <i class="far fa-heart"></i>
                  @endguest
              </button>
              </button>
            </form>	
          </div>
          <div style="height: 190px; max-width: 270px; display: flex; align-items: center; margin-left: auto; margin-right: auto;">
            <img src="{{ Storage::url($wishlist->produk->foto) }}" class="card-img-top" style="height: 150px; width: 100%;" alt="...">
          </div>
          <div class="card-body">
            <div>
              @if(isset($wishlist->produk->user->toko->nama_toko))
                <a class="text-decoration-none fw-semibold text-dark" href="{{ route('homepage.toko', $wishlist->produk->user_id) }}">{{ $wishlist->produk->user->toko->nama_toko }}</a>
              @else
                <p class="fw-semibold text-dark">{{ $wishlist->produk->user->name }}</p>
              @endif
            </div>
            <div>
              <p class="card-text txt">{{ $wishlist->produk->nama_produk }}</p>
            </div>
            @if (isset($wishlist->produk->promoted_produk->produk_id))
             
              @if($wishlist->produk->id == $wishlist->produk->promoted_produk->produk_id)
                <div>
                  <p class="card-text fw-bold">Harga Diskon</p>
                </div>
                <div>
                  <button type="button" class="btn btn-danger"
                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" disabled>
                  </button>
                  <span class="text-muted text-decoration-line-through">Rp. {{ number_format($wishlist->produk->promoted_produk->harga_awal, 2) }}</span>
                </div>
                <div>
                  <span>Rp. {{ number_format($wishlist->produk->promoted_produk->harga_akhir, 2) }}</span>
                </div>                 
              @endif
            @else
              <div>
                <p class="card-text fw-bold">Harga</p>
              </div>
              <div>
                <span>Rp. {{ number_format($wishlist->produk->harga, 2) }}</span>
              </div>
            @endif
            <div>
              @if ($wishlist->produk->rating)
                @for ($x = 0; $x < $wishlist->produk->rating->avg('rating'); $x++)
                  <i class="fa-solid fa-star text-warning"></i>
                @endfor
              @endif
            </div>
          </div>
          <form action="{{ route('cart.store') }}" method="POST" class="mx-3" style="display: inline-block;">
              @csrf
              <input type="hidden" name="produk_id" value={{$wishlist->produk->id}}>
              <input type="hidden" name="seller_id" value={{$wishlist->produk->user->id}}>
              <input type="hidden" name="qty" value="1">
              @if (isset($wishlist->produk->promoted_produk->produk_id))
                <input type="hidden" name="harga" value="{{ $wishlist->produk->promoted_produk->harga_akhir }}">
              @else
                <input type="hidden" name="harga" value="{{ $wishlist->produk->harga }}">
              @endif
              <button  class="btn btn btn-outline-dark btn-sm mb-2" type="submit" style=" width:100%;">
              Add To Cart
              </button>
          </form>
          <a href="{{ URL::to('produk/'.$wishlist->produk->slug_produk ) }}" type="button" class="btn btn-dark btn-sm mb-2 mx-3">Details</a>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection