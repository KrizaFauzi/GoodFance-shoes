@extends('layouts.template')
@section('content')
<style>
  .contain{
    min-height: 73.5vh;
    max-width: 92vw;
  }
  .top{
    top: 6px;
    right: 6px;
  }
</style>
<div class="contain container-fluid" >
  <div class="row mt-4 ">
    <div class="col col-lg-3 col-md-3 mb-2">
      <div class="card">
        <div class="card-header">
          Kategori
        </div>
        <ul class="list-group list-group-flush">
          @foreach($listkategori as $kategori)
          <a href="{{ URL::to('category/'.$kategori->slug_kategori) }}" class="text-decoration-none">
            <li class="list-group-item">{{ $kategori->nama_kategori }}</li>
          </a>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="col col-lg-9 col-md-9 mb-2">
      @if(isset($itemkategori))
      <h3>{{ $itemkategori->nama_kategori }}</h3>
      @else
      <h3>Semua Kategori</h3>
      @endif
      <div class="row mt-4">
        @foreach($itemproduk as $produk)

        <div class="col-md-4">
          <div class="card mb-4 position-relative" style="height: 415px;">
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
                <i class="fa-solid fa-star text-warning"></i>
                <span>5.0</span>
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
      <div class="row">
        <div class="col">
          {{ $itemproduk->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection