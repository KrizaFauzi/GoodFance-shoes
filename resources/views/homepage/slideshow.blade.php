
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

    <div class="contain container mt-4">
        <h2 class="text-center">Event {{ $event->nama_event }}</h2>
        <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
            @foreach ($promo as $promo)
                @foreach($promo->promoted_produk as $promoted_produk)
                    <div class="col">
                        <div class="card" style="height: 415px;">
                            <div class="position-absolute top">
                                <form action="{{ route('wishlist.store') }}" method="post">
                                  @csrf
                                    <input type="hidden" name="produk_id" value={{ $promoted_produk->produk->id }}>
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                      @auth
                                        @if($promoted_produk->produk->wish(Auth::user()->id, $promoted_produk->produk->id))
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
                                @if ($promoted_produk->produk->foto)
                                    <img src="{{ Storage::url($promoted_produk->produk->foto) }}" class="card-img-top" style="height: 150px; width: 100%;" alt="...">
                                @else
                                    <img src="{{ asset('images/NoImage2.jpg') }}" class="card-img-top" style="height: 150px; width: 100%;" alt="...">
                                @endif
                            </div>
                            <div class="card-body">
                                <div>
                                    @if(isset($promoted_produk->produk->user->toko->nama_toko))
                                      <a class="text-decoration-none fw-semibold text-dark" href="{{ route('homepage.toko', $promoted_produk->produk->user_id) }}">{{ $promoted_produk->produk->user->toko->nama_toko }}</a>
                                    @else
                                      <p class="fw-semibold text-dark">{{ $promoted_produk->produk->user->name }}</p>
                                    @endif
                                </div>
                                <div>
                                    <p class="card-text txt">{{ $promoted_produk->produk->nama_produk }}</p>
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
                                <div>
                                    @if ($promoted_produk->produk->rating)
                                        @for ($x = 0; $x < $promoted_produk->produk->rating->avg('rating'); $x++)
                                            <i class="fa-solid fa-star text-warning"></i>
                                        @endfor
                                    @endif
                                </div>
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