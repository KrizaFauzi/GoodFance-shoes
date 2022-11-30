@extends('layouts.template')
@section('content')
<style>
    .contain{
        min-height: 73vh;
    }
    .contain select{
        display: block;
        padding: 5px 10px;
    }
    .contain input{
        width: 65px;
        height: 37px;
        padding-left: 10px;
        font-size: 16px;
    }
    .contain input:focus{
        outline: none;
    }
    .btn-cart{
        color: white;
        background-color: black;
        opacity: 1;
        transition: 0.3s all;
        width: 120px;
        height: 37px;
    }
    .content{
        font-size: 14px;
    }
    .col{
        height: 100%;
        width: 100%;
    }
    .small-img-group{
        display: flex;
        justify-content: flex-start;
    }
    .small-img-col{
        flex-basis: 20%;
        cursor: pointer;
    }
    #main-img{
        width: 600px;
        height: 400px;
        object-fit: contain;
    }
    .small-img{
        width: 100px;
        height: 100px;
        object-fit: contain;
    }
    .fd{
        flex-basis: 10%;
    }
    .bg{
        background-color: rgb(244, 244, 244)
    }
    .rate{
        min-height: 50vh;
    }
</style>

<div class="contain container mt-4">
    @if($itemproduk->dibeli(Auth::user()->id, $itemproduk->id))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-dark">
                    Berikut tampilan produk yang dipesan pada {{ $itemproduk->tanggalDibeli(Auth::user()->id, $itemproduk->id) }}
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-3" >
        <div class="col-lg-5 col-md-12 col-4" >
            @if ($itemproduk->foto)
                <img class="img-fluid w-100 pb-1" id="main-img" src="{{ Storage::url($itemproduk->foto) }}" alt="">
            @else
                <img class="img-fluid w-100 pb-1" id="main-img" src="{{ asset('images/NoImage2.jpg') }}" alt="">
            @endif
            <div class="small-img-group">
                @foreach ($gambar as $gambar)
                    <div class="small-img-col">
                        <img class="small-img" width="100%" onclick="index({{ $no++ }})" src="{{ Storage::url($gambar->foto) }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-8" >
            <div class="d-flex justify-content-between">
                <h6 class="py-4">
                    @if(isset($itemproduk->user->toko->nama_toko))
                        <a class="text-decoration-none fw-semibold text-dark" href="{{ route('homepage.toko', $itemproduk->user_id) }}">{{ $itemproduk->user->toko->nama_toko }}</a>
                    @else
                        <span class="fw-semibold text-dark">{{ $itemproduk->user->name }}</span>
                    @endif 
                    / <a class="text-decoration-none text-muted" href="{{ route('search.category',$itemproduk->kategori->slug_kategori) }}">{{ $itemproduk->kategori->nama_kategori }}</a> 
                </h6>
                <form action="{{ route('wishlist.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="produk_id" value={{ $itemproduk->id }}>
                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                        @auth
                        @if($itemproduk->wish(Auth::user()->id, $itemproduk->id))
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
            <h3 class="fw-bold">{{ $itemproduk->nama_produk }}</h3>
            <div class="d-flex justify-content-start mb-0">
                <span>
                    @for ($x = 0; $x < (int) $ratingCount; $x++)
                        <i class="fa-solid fa-star text-warning"></i>
                    @endfor
                </span>
                <span class="ms-1"> | </span>
                <span class="ms-1">
                    {{ $penilaian }} Penilaian
                </span>
                <span class="ms-1"> | </span>
                <span class="ms-1">
                    {{ $terjual }} Terjual
                </span>
            </div>
            <hr>
            @if(isset($itemproduk->promoted_produk))
                <h6 class="text-decoration-line-through">Rp. {{ number_format($itemproduk->promoted_produk->harga_awal) }}</h6>
                <h2>Rp. {{ number_format($itemproduk->promoted_produk->harga_akhir) }}</h2>
            @else
                <h2>Rp.{{ number_format($itemproduk->harga) }}</h2>
            @endif
            <span>Stok = {{ $itemproduk->qty }}</span>
            <hr>
            <form action="{{ route('cart.store') }}" method="post">
                @csrf
                <div class="d-flex justify-content-start">
                    <select class="my-2" name="ukuran" id="ukuran">
                        <option>Pilih Ukuran</option>
                        <@forelse ($itemproduk->ukuran as $ukuran)
                            <option value="{{ $ukuran->ukuran }}">{{ $ukuran->ukuran }}</option>
                        @empty
                            <option value="">Tidak ada pilihan ukuran</option>
                        @endforelse
                    </select>
                    <select class="my-2" name="warna" id="warna" style="margin-left: 5px;">
                        <option>Pilih Warna</option>
                        @forelse ($itemproduk->warna as $warna)
                            <option value="{{ $warna->warna }}">{{ $warna->warna }}</option>
                        @empty
                            <option value="">Tidak ada pilihan warna</option>
                        @endforelse
                    </select>
                </div>
                <input type="hidden" name="produk_id" value={{$itemproduk->id}}>
                <input type="hidden" name="seller_id" value={{$itemproduk->user->id}}>
                <input type="hidden" name="harga" value="{{ $itemproduk->harga }}">
                @if(isset($itemproduk->promoted_produk))
                    <input type="hidden" name="harga" value="{{ $itemproduk->promoted_produk->harga_akhir }}">
                @else
                    <input type="hidden" name="harga" value="{{ $itemproduk->harga }}">
                @endif
                <input type="number" name="qty" value="1" min="1" max="{{ $itemproduk->qty }}">
                <button type="submit" class="btn-cart">Add To Cart</button>
            </form>
            <h4 class="mt-5 mb-3 fw-semibold">Product Detail</h4>
            <span class="content">{{ $itemproduk->deskripsi_produk }}</span>
        </div>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col">
            <div class="bg p-4 rate">
                <h2>Rating & Review</h2><hr>
                @foreach ($rating as $rating)
                    <div class="container p-3">
                        <div class="d-flex justify-content-start align-items-center">
                            <img class="rounded-circle" width="35px" height="35px" src="{{ asset('img/unknownwn.png') }}" alt="">
                            <h5 class="ms-2 ">{{ $rating->user->name }}</h5>
                        </div>
                        <div class="" style="margin-left: 42px;">
                            @for ($i = 0; $i < $rating->rating; $i++)
                                <i class="fa-solid fa-star text-warning"></i>
                            @endfor
                        </div>
                        <div class="" style="margin-left: 42px;">
                            <p>{{ date_format($rating->created_at,"Y/m/d");  }}</p>
                        </div>
                        <div class="" style="margin-left: 42px;">
                            <p>{{ $rating->ulasan }}</p>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
    const MainImg = document.getElementById('main-img');
    const smallImg = document.getElementsByClassName('small-img');

    const index = (index) => {
        MainImg.src = smallImg[index].src;
    };
</script>
@endsection