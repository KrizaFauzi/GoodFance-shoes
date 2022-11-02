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
        height: 400px;
        width: 100%;
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
                    <div class="main_image">	
                        <img src="img/photo2.png" id="main_product_image" class="img-fluid" width="590">	
                        <div id="zoom"></div>
                    </div>	
                    <div class="thumbnail_images">	
                        <ul id="thumbnail">	
                            <li>
                                <img onclick="changeImage(this)" src="img/photo2.png" width="70">
                            </li>	
                            <li>
                                <img onclick="changeImage(this)" src="img/photo1.png" width="70">
                            </li>	
                            <li>
                                <img onclick="changeImage(this)" src="img/photo3.jpg" width="70">
                            </li>	
                            <li>
                                <img onclick="changeImage(this)" src="img/photo4.jpg" width="70">
                            </li>	
                        </ul>	
                    </div>	
                </div>	
            </div>	
            <div class="col-md-6 bg-dark text-white">	
                <div class="p-3 right-side">	
                    <div class="d-flex justify-content-between align-items-center">	
                        <h3>Judul</h3>
                    </div>
                    <hr class="my-1">
                    <div class="mt-2">
                        <button class="collapsible"><p class="text-collapse">See more <span><i class="fa-solid fa-chevron-down fs-6"></i></span></p></button>
                        <div class="content">
                            <h6 style="font-size: 16px;" class="fw-bold mt-2">About this Item:</h6>
                            <p class="fw-normal">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                    </div>
                    <div class="mt-1">
                        <h3>$430.99</h3>	
                        <div class="ratings d-flex flex-row align-items-center">	
                            <div class="d-flex flex-row">	
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
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
                        <span class="fw-bold">Quantity</span>
                        <div class="input-group input-group-sm mt-1" style="width: 21.5%;">
                            <label class="input-group-text" for="inputGroupSelect01">Qty</label>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="buttons d-flex flex-row mt-5 gap-3">	
                        <button class="btn btn-outline-light">Buy Now</button>	
                        <button class="btn btn-light">Add to Cart</button>	
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