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


<!-- As a heading -->
<nav class="navbar bg-dark shadow py-1">
  <div class="container-fluid">
      <div class="">
          <button class="btn btn-info text-white" style="padding: 3px 10px 3px 10px" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
              <i class="fa-solid fa-filter me-1"></i>Filter
          </button>

          <div class="offcanvas offcanvas-top" style="height: 210px;" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
              <div class="offcanvas-header pb-2">
                  <h3 class="offcanvas-title fw-bold" id="offcanvasTopLabel">Filter</h3>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <hr class="my-0 mb-2">
              <div class="offcanvas-body pt-0">
                  <div class="container-fluid ">
                      <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3 ">
                        <form action="/search" method="POST"  style="display: inline-block; width:100%;">
                          @csrf
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="col">
                              <p class="mb-0">Urutkan berdasarkan:</p>
                              <select name="urutan" class="form-select form-select-sm" aria-label="Default select example">
                                  <option value="" selected>Terkait</option>
                                  <option value="Terendah - Tertinggi">Harga: Terendah - Tertinggi</option>
                                  <option value="Tertinggi - Terendah">Harga: Tertinggi - Terendah</option>
                              </select>
                            </div>
                            <div class="col">
                              <p class="mb-0">Batas Harga</p>
                                <div class="row g-2">
                                    <div class="input-group col">
                                        <span class="input-group-text bg-white border border-end-0" id="basic-addon1">Rp</span>
                                        <input name="min" type="number" class="form-control bg-white border border-start-0" placeholder="Min">
                                    </div>
                                    <div class="input-group col">
                                        <span class="input-group-text bg-white border border-end-0" id="basic-addon1">Rp</span>
                                        <input name="max" type="number" class="form-control bg-white border border-start-0" placeholder="Max">
                                    </div>
                                  </div>
                            </div>
                          </div>
                          <input type="hidden" name="search" value="{{ $search }}">
                          <button type="submit" class="btn btn-info mt-2 w-100 shadow">Submit</button>
                        </form>                          
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</nav>

<div class="contain container-fluid mt-4 mb-4" >
    <div style="margin-left: 60px; margin-right: 60px;">
        <h4 class="fw-semibold">Hasil Pencarian " {{ $search }} "</h4>
        <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3" >
            @foreach($produk as $produk)
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
                    @if ($produk->foto)
                      <img src="{{ Storage::url($produk->foto) }}" class="card-img-top" style="height: 150px; width: 100%;" alt="...">
                    @else
                      <img src="{{ asset('images/NoImage2.jpg') }}" class="card-img-top" style="height: 150px; width: 100%;" alt="...">
                    @endif
                  </div>
                  <div class="card-body">
                    <div>
                      @if(isset($produk->user->toko->nama_toko))
                        <a class="text-decoration-none fw-semibold text-dark" href="{{ route('homepage.toko', $produk->user_id) }}">{{ $produk->user->toko->nama_toko }}</a>
                      @else
                        <p class="fw-semibold text-dark">{{ $produk->user->name }}</p>
                      @endif
                    </div>
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
                        @for ($x = 0; $x < $produk->rating->avg('rating'); $x++)
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