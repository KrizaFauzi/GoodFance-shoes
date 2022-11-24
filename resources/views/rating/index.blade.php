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
    .rating {
        display: flex;
        margin-top: -10px;
        flex-direction: row-reverse;
        margin-left: -4px;
        float: left;
    }

    .rating>input {
        display: none;
    }

    .rating>label {
        position: relative;
        width: 19px;
        font-size: 25px;
        color: darkorange;
        cursor: pointer;
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0;
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important
    }
    .rating>input:checked~label:before {
        opacity: 1
    }
    .rating:hover>input:checked~label:before {
        opacity: 0.4
    }

</style>
<div class="contain container mt-4">
    <div class="row" >
        @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-warning">{{ $error }}</div>
        @endforeach
        @endif
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
        <div class="col-lg-5 col-md-12 col-4" >
            <img class="img-fluid w-100 pb-1" id="main-img" src="{{ Storage::url($itemproduk->foto) }}" alt="">
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
                <h6 class="py-4">Category / {{ $itemproduk->kategori->nama_kategori }}</h6>
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
            @if(isset($itemproduk->promoted_produk))
                <h6 class="text-decoration-line-through">Rp. {{ number_format($itemproduk->promoted_produk->harga_awal) }}</h6>
                <h2>Rp. {{ number_format($itemproduk->promoted_produk->harga_akhir) }}</h2>
            @else
                <h2>Rp.{{ number_format($itemproduk->harga) }}</h2>
            @endif
            <p>Stok = {{ $itemproduk->qty }}</p>
            <form action="{{ route('cart.store') }}" method="post">
                @csrf
                <div class="d-flex justify-content-start">
                    <select class="my-2" name="" id="">
                        <option>Pilih Ukuran</option>
                        <option value="">S</option>
                    </select>
                    <select class="my-2" name="" id="" style="margin-left: 5px;">
                        <option>Pilih Warna</option>
                        <option value="">S</option>
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
        <div class="col col-lg-6 col-md-6">
            <div class="bg p-4 rate">
                <h2>Beri Rating & Review</h2><hr>
                @if (isset($rating))
                <div class="container p-3">
                    <div class="d-flex justify-content-start align-items-center">
                        <img class="rounded-circle" width="35px" height="35px" src="{{ asset('img/unknownwn.png') }}" alt="">
                        <h5 class="ms-2 ">{{ Auth::user()->name }}</h5>
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
                @else
                    <form action="{{ route('rating.store', $itemproduk->id) }}" method="post">
                        @csrf
                        <div class="form-group my-2 d-flex align-items-center">
                            <div class="rating" style="margin-left: 5px">
                                <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
                                <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea rows="15" type="text" name="ulasan" id="ulasan" class="form-control"></textarea>
                        </div>
                        <div class="form-group d-flex justify-content-end mt-3">
                            <input type="hidden" name="produk_id" value="{{ $itemproduk->id }}">
                            <button class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                @endif
                
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