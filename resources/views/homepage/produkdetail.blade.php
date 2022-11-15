@extends('layouts.template')
@section('content')
<style>
    .checked {
        color: orange;
    }
    body{
        background-color: #ecedee;
    }
    .card{
        border: none;
        overflow: hidden;
    }
    .thumbnail_images ul{
        list-style: none;
        justify-content: center;
        display: flex;
        align-items: center;
        margin-top: 10px;
        overflow-x: auto;
    }
    .thumbnail_images ul li{
        margin: 5px;
        padding: 10px;
        border: 2px solid #eee;
        cursor: pointer;
        transition: all 0.5s;
    }
    .thumbnail_images ul li:hover{
        border: 2px solid #000;
    }
    .main_image{
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #eee;

        overflow: hidden;
    }
    .content p{
        font-size: 14px;
    }
    .ratings span{
        font-size: 14px;
    }
    .colors{
        margin-top: 5px;
    }
    .colors ul{
        list-style: none;
        display: flex;
        padding-left: 0px;
    }
    .colors ul li{
        height: 20px;
        width: 20px;
        display: flex;
        border-radius: 50%;
        margin-right: 10px;
        cursor: pointer;
    }
    .colors ul li:nth-child(1){
        background-color: #6c704d;
    }
    .colors ul li:nth-child(2){
        background-color: #96918b;
    }
    .colors ul li:nth-child(3){
        background-color: #68778e;
    }
    .colors ul li:nth-child(4){
        background-color: #263f55;
    }
    .colors ul li:nth-child(5){
        background-color: black;
    }
    .right-side{
        position: relative;
    }
    .input-group .form-select:focus{
        border-color: #0f3c4c;
        box-shadow: 0 0 0 0.2rem rgba(147, 147, 147, 0.8);
    }
    body.active img {
        -webkit-filter: grayscale(1);
    }

    img {
        display: block;
        margin: 20px auto;
        border: 1px solid rgba(255,255,255,0.2);
        -webkit-transition: -webkit-filter 500ms;
    }

    img .img-cover{
        height: 300px;
        width: 100%;
        object-fit: cover;
    }

    #zoom {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 250px;
        height: 250px;
        margin: -125px 0 0 -125px;
        background-repeat: no-repeat;
        box-shadow: 0 0 0 2px rgba(255,0,0,0.5),
            5px 5px 10px 5px rgba(0,0,0,0.2);
        border-radius: 50%;
        opacity: 0;
        -webkit-transform: scale(0);
        -webkit-transition: opacity 500ms, -webkit-transform 500ms;
        pointer-events: none;
        text-decoration: none;
    }

    .active #zoom {
        opacity: 1;
        -webkit-transform: scale(1);
    }
    .collapsible {
        background-color: transparent;
        color: rgb(183, 255, 231);
        cursor: pointer;
        padding: 0;
        width: auto;
        height: 25px;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
    }

    .text-collapse:hover {
        background-color: transparent;
        text-decoration: underline;
        color: aqua;
    }

    .content {
        padding-left: 1.5px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
        background-color: transparent;
    }
</style>

<div class="mt-1">	
    <div class="card rounded-0">	
        <div class="row g-0">	
            <div class="col-md-6 border-end">	
                <div class="d-flex flex-column justify-content-center">	
                    <div class="main_image bg-secondary">	
                        <img src="{{ Storage::url($itemproduk->foto) }}" id="main_product_image" class="img-cover" >	
                        <div id="zoom"></div>
                    </div>	
                    <div class="thumbnail_images">	
                        <ul id="thumbnail">	
                            <li>
                                <img onclick="changeImage(this)" src="{{ Storage::url($itemproduk->foto) }}" width="90">
                            </li>	
                        </ul>	
                    </div>	
                </div>	
            </div>
            <div class="col-md-6 bg-dark text-white">	
                <div class="p-3 right-side">	
                    <div class="align-items-center d-flex justify-content-between">	
                        <h3>{{ $itemproduk->nama_produk }}</h3>
                        <form action="{{ route('wishlist.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="produk_id" value={{ $itemproduk->id }}>
                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                            @if(isset($itemwishlist) && $itemwishlist)
                            <i class="fas fa-heart"></i>
                            @else
                            <i class="far fa-heart"></i>
                            @endif
                            </button>
                        </form>	
                    </div>
                    <hr class="my-1">
                    <div class="mt-2">
                        <button class="collapsible"><p class="text-collapse">Deskripsi <span><i class="fa-solid fa-chevron-down fs-6"></i></span></p></button>
                        <div class="content">
                            <p class="fw-normal">{{ $itemproduk->deskripsi_produk }}</p>
                        </div>
                    </div>
                    <div class="mt-1">
                        @if(isset($itemproduk->promoted_produk))
                                <h3>Rp.{{ number_format($itemproduk->promoted_produk->harga_akhir) }}</h3>	
                            @else
                                <h3>Rp.{{ number_format($itemproduk->harga) }}</h3>	
                        @endif
                        
                        <div class="ratings d-flex flex-row align-items-center">	
                            <div>
                                <i class="fa-solid fa-star text-warning"></i>
                                <span>5.0</span>
                            </div>	
                        </div>
                    </div>	
                    <div class="mt-3">	
                        <span class="fw-bold">Color</span>	
                        <div class="colors">	
                            <ul id="marker">	
                                <li id="marker-1"></li>	
                                <li id="marker-2"></li>	
                                <li id="marker-3"></li>	
                                <li id="marker-4"></li>	
                                <li id="marker-5"></li>	
                            </ul>	
                        </div>	
                    </div>	
                    <div class="quantity">
                        <span>Stock = {{ $itemproduk->qty }}</span><br>
                    </div>
                    <div class="buttons d-flex flex-row mt-3 gap-3">
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="produk_id" value='{{$itemproduk->id}}'>
                            <input type="hidden" name="seller_id" value='{{$itemproduk->user->id}}'>
                            <div class="col">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0 rounded-start" id="qty">Qty</span>
                                    </div>
                                    <input type="number" class="form-control" name="qty" value="1" min="1" max="{{ $itemproduk->qty }}">
                                </div>
                            </div>
                            <button class="btn btn-block btn-primary mt-3" type="submit">
                            <i class="fa fa-shopping-cart"></i> Tambahkan Ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>	
            </div>	
        </div>	
    </div> 
</div>
<script>
function changeImage(element) {
    var main_prodcut_image = document.getElementById('main_product_image');
    main_prodcut_image.src = element.src;
}

// image zoom effect
(function() {
  var zoom = document.getElementById( 'zoom' ),
      Zw = zoom.offsetWidth,
      Zh = zoom.offsetHeight,
      img = document.querySelector( 'img' );
      
  
  var timeout, ratio, Ix, Iy;

  function activate () {
    document.body.classList.add( 'active' );
  }
  
  function deactivate() {
    document.body.classList.remove( 'active' );
  }
  
  function updateMagnifier( x, y ) {
    zoom.style.top = ( y ) + 'px';
    zoom.style.left = ( x ) + 'px';
    zoom.style.backgroundPosition = (( Ix - x ) * ratio + Zw / 2 ) + 'px ' + (( Iy - y ) * ratio + Zh / 2 ) + 'px';
  }
  
  function onLoad () {
    ratio = img.naturalWidth / img.width;
    zoom.style.backgroundImage = 'url(' + img.src + ')';
    Ix = img.offsetLeft;
    Iy = img.offsetTop;
  }
  
  function onMousemove( e ) {
    clearTimeout( timeout );
    activate();
    updateMagnifier( e.x, e.y );
    timeout = setTimeout( deactivate, 2500 );
  }
  
  function onMouseleave () {
    deactivate();
  }

  img.addEventListener( 'load', onLoad );
  img.addEventListener( 'mousemove', onMousemove );
  img.addEventListener( 'mouseleave', onMouseleave );

})();

// collapse detail
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>
@endsection