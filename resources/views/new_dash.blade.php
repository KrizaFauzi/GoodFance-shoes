<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <title> Dashboard </title>

    <style>
        @import 'https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,400';
        /* colors */
        /* tab setting */
        /* breakpoints */
        /* selectors relative to radio inputs */
        html {
            width: 100%;
            height: 100%;
        }

        body {
            color: #333;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            height: 100%;
        }

        body h1 {
            text-align: center;
            color: #428BFF;
            font-weight: 300;
            padding: 40px 0 20px 0;
            margin: 0;
        }

        .tabs {
            position: relative;
            background: white;
            width: 100%;
            height: 100%;
            min-width: 240px;
        }

        .tabs input[name=tab-control] {
            display: none;
        }

        .tabs .content section h2,
        .tabs ul li label {
            font-family: "Montserrat";
            font-weight: bold;
            font-size: 15px;
            color: #428BFF;
        }

        .tabs ul {
            list-style-type: none;
            padding-left: 0;
            display: flex;
            flex-direction: row;
            margin-bottom: 10px;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .tabs ul li {
            box-sizing: border-box;
            flex: 1;
            width: 25%;
            padding: 0 10px;
            text-align: center;
        }

        .tabs ul li label {
            transition: all 0.3s ease-in-out;
            color: #929daf;
            padding: 5px auto;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .tabs ul li label br {
            display: none;
        }

        .tabs ul li label svg {
            fill: #929daf;
            height: 1.2em;
            vertical-align: bottom;
            margin-right: 0.2em;
            transition: all 0.2s ease-in-out;
        }

        .tabs ul li label:hover, .tabs ul li label:focus, .tabs ul li label:active {
            outline: 0;
            color: #bec5cf;
        }

        .tabs ul li label:hover svg, .tabs ul li label:focus svg, .tabs ul li label:active svg {
            fill: #bec5cf;
        }

        .tabs .slider {
            position: relative;
            width: 25%;
            transition: all 0.33s cubic-bezier(0.38, 0.8, 0.32, 1.07);
        }

        .tabs .slider .indicator {
            position: relative;
            width: 25%;
            max-width: 100%;
            margin: 0 auto;
            height: 3px;
            background: #428BFF;
            border-radius: 1px;
        }

        .tabs .content {
            margin-top: 30px;
            width: 100%;
        }

        .tabs .content section {
            display: none;
            -webkit-animation-name: content;
                    animation-name: content;
            -webkit-animation-direction: normal;
                    animation-direction: normal;
            -webkit-animation-duration: 0.3s;
                    animation-duration: 0.3s;
            -webkit-animation-timing-function: ease-in-out;
                    animation-timing-function: ease-in-out;
            -webkit-animation-iteration-count: 1;
                    animation-iteration-count: 1;
            line-height: 1.4;
        }

        .tabs .content section h2 {
            color: #428BFF;
            display: none;
        }

        .tabs .content section h2::after {
            content: "";
            position: relative;
            display: block;
            width: 30px;
            height: 3px;
            background: #428BFF;
            margin-top: 5px;
            left: 1px;
        }

        .tabs input[name=tab-control]:nth-of-type(1):checked ~ ul > li:nth-child(1) > label {
            cursor: default;
            color: #428BFF;
        }

        .tabs input[name=tab-control]:nth-of-type(1):checked ~ ul > li:nth-child(1) > label svg {
        fill: #428BFF;
        }

        @media (max-width: 600px) {
            .tabs input[name=tab-control]:nth-of-type(1):checked ~ ul > li:nth-child(1) > label {
                background: rgba(0, 0, 0, 0.08);
            }
        }

        .tabs input[name=tab-control]:nth-of-type(1):checked ~ .slider {
            transform: translateX(0%);
        }

        .tabs input[name=tab-control]:nth-of-type(1):checked ~ .content > section:nth-child(1) {
            display: block;
        }

        .tabs input[name=tab-control]:nth-of-type(2):checked ~ ul > li:nth-child(2) > label {
            cursor: default;
            color: #428BFF;
        }

        .tabs input[name=tab-control]:nth-of-type(2):checked ~ ul > li:nth-child(2) > label svg {
            fill: #428BFF;
        }

        @media (max-width: 600px) {
            .tabs input[name=tab-control]:nth-of-type(2):checked ~ ul > li:nth-child(2) > label {
                background: rgba(0, 0, 0, 0.08);
            }
        }

        .tabs input[name=tab-control]:nth-of-type(2):checked ~ .slider {
            transform: translateX(100%);
        }

        .tabs input[name=tab-control]:nth-of-type(2):checked ~ .content > section:nth-child(2) {
            display: block;
        }

        .tabs input[name=tab-control]:nth-of-type(3):checked ~ ul > li:nth-child(3) > label {
            cursor: default;
            color: #428BFF;
        }

        .tabs input[name=tab-control]:nth-of-type(3):checked ~ ul > li:nth-child(3) > label svg {
            fill: #428BFF;
        }

        @media (max-width: 600px) {
            .tabs input[name=tab-control]:nth-of-type(3):checked ~ ul > li:nth-child(3) > label {
                background: rgba(0, 0, 0, 0.08);
            }
        }

        .tabs input[name=tab-control]:nth-of-type(3):checked ~ .slider {
            transform: translateX(200%);
        }

        .tabs input[name=tab-control]:nth-of-type(3):checked ~ .content > section:nth-child(3) {
            display: block;
        }

        .tabs input[name=tab-control]:nth-of-type(4):checked ~ ul > li:nth-child(4) > label {
            cursor: default;
            color: #428BFF;
        }

        .tabs input[name=tab-control]:nth-of-type(4):checked ~ ul > li:nth-child(4) > label svg {
            fill: #428BFF;
        }

        @media (max-width: 600px) {
            .tabs input[name=tab-control]:nth-of-type(4):checked ~ ul > li:nth-child(4) > label {
                background: rgba(0, 0, 0, 0.08);
            }
        }
        .tabs input[name=tab-control]:nth-of-type(4):checked ~ .slider {
            transform: translateX(300%);
        }

        .tabs input[name=tab-control]:nth-of-type(4):checked ~ .content > section:nth-child(4) {
            display: block;
        }

        @media (max-width: 1000px) {
            .tabs ul li label {
                white-space: initial;
            }
            .tabs ul li label br {
                display: initial;
            }
            .tabs ul li label svg {
                height: 1.5em;
            }
        }

        @media (max-width: 600px) {
            .tabs ul li label {
                border-radius: 5px;
            }

            .tabs ul li label span {
                display: none;
            }

            .tabs .slider {
                display: none;
            }

            .tabs .content {
                margin-top: 20px;
            }

            .tabs .content section h2 {
                display: block;
            }
        }

        .dropdown{
            width: 140px;
            display: inline-block;
            position: relative;
        }

        .dropdown.toggle > input{
            display: block;
        }

        .dropdown > a, .dropdown.toggle > label{
            border-radius: 2px;
        }

        .dropdown ul{
            list-style-type: none;
            display: block;
            margin: 0;
            padding: 0 0 0 0;
            position: absolute;
            width: 100%;
            box-shadow: 0 6px 5px -5px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .dropdown a, .dropdown.toggle > label{
            display: block;
            padding: 0 10px 0 10px;
            text-decoration: none;
            height: auto;
            font-size: 13px;
            background-color: #fff; 
        }

        .dropdown li{
            height: 0;
            overflow: hidden;
        }

        .dropdown.hover li{
            transition-delay: 0ms;
        }

        .dropdown li:first-child a{
            border-radius: 2px 2px 0 0; 
        }

        .dropdown li:last-child a {
            border-radius: 0 0 2px 2px;
        }

        .dropdown li:first-child a::before{
            content: "";
            display: block;
            position: absolute;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 10px solid #fff;
            margin: -10px 0 0 30px; 
        }

        .dropdown a:hover, .dropdown.toggle > label:hover, .dropdown.toggle > input:checked ~ label::after{
            border-top-color: #aaa;
        }

        .dropdown.hover:hover li, .dropdown.toggle > input:checked ~ ul li{
            height: auto;
        }

        .dropdown.hover:hover li:first-child, .dropdown.toggle > input:checked ~ ul li:first-child{
            margin-top: 15px;
        }
        .form-control:focus {
            border-color: #0f3c4c;
            box-shadow: 0 0 0.1em 0.1em rgba(147, 147, 147, 0.8);
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar bg-white px-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">GoodFance</a>

            <div class="d-flex justify-content-end">
                <div class="dropdown hover ms-3 me-3" style="z-index: 2;">
                    <a class="bg-info text-black rounded-pill text-center py-2 fw-semibold" href="#">
                        Hello, {{ Auth::user()->name }}
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <ul class="menu-dropdown" style="width: 190px;">
                        <li><a href="/">Kembali ke GoodFance</a></li>
                        <li>
                            <a style="padding-top: 2.5px; padding-bottom: 7px;" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>
                
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

<div class="container-fluid tabs">
  
  <input type="radio" id="tab1" name="tab-control" checked>
  <input type="radio" id="tab2" name="tab-control">
  <input type="radio" id="tab3" name="tab-control">  
  <input type="radio" id="tab4" name="tab-control">
  <ul>
    <li title="Features">
        <label for="tab1" role="button">
            <i class="fa-solid fa-user me-2"></i><span>Profile</span>
        </label>
    </li>
    <li title="Delivery Contents">
        <label for="tab2" role="button">
            <i class="fa-solid fa-plus me-2"></i><span>Produk</span> 
        </label>
    </li>
    <li title="Shipping">
        <label for="tab3" role="button">
            <i class="fa-solid fa-shirt me-2"></i><span>Kategori</span> 
        </label> 
    </li>    
    <li title="Returns">
        <label for="tab4" role="button">
            <i class="fa-solid fa-percent me-2"></i><span>Promo</span> 
        </label>
    </li>
  </ul>
  
  <div class="slider"><div class="indicator"></div></div>
  <div class="content bg-light h-100 mt-0">
    <section>
        <h2>Profile</h2>
        <div class="container px-4">
            <div class="py-2" style="margin: auto; width: 59%;">
        
                <!-- Edit name -->
                <div class="container rounded-top bg-white mt-3 shadow-sm">
                    <p class="pt-2 fw-normal">Edit Nama Kamu Disini</p>
                    <div class="pt-1 fs-3 fw-bolder">{{ Auth::user()->name }}
                        <span>
                            <button type="button" class="btn border-0 fs-5 ps-0" data-bs-toggle="modal" data-bs-whatever="EditNama" data-bs-target="#nama">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </span>
                            
                        <!-- Modal -->
                        <div class="modal fade" id="nama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 py-0 fw-bolder text-dark" id="staticBackdropLabel">Edit your name</h1>
                                        <button type="button" class="btn-close fs-5" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" class="form-control" id="edit-nama" placeholder="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-info fw-normal">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Edit nmr telepon -->
                <div class="container bg-white mt-3 shadow-sm">
                    <p class="pt-2 fw-normal">Edit Nomor Telepon dan Alamat</p>
                    <div class="pt-1 fs-6 fw-bolder position-relative">Nomor Telepon
                        <span>
                            <button type="button" class="btn border-0 fs-5 position-absolute" style="right: 0;" data-bs-toggle="modal" data-bs-whatever="NmrTelepon" data-bs-target="#telepon">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </span>
                            
                        <!-- Modal -->
                        <div class="modal fade" id="telepon" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 py-0 fw-bolder text-dark" id="staticBackdropLabel">Edit Nomor Telepon dan Alamat</h1>
                                        <button type="button" class="btn-close fs-5" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label>Nomor Telepon</label>
                                        <input type="text" class="form-control" id="nmr-telepon" placeholder="">
                                        <label class="mt-1">Alamat</label>
                                        <input type="text" class="form-control" id="nmr-telepon" placeholder="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-info fw-normal">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 fs-6">
                        <p class="fw-semibold">{{ Auth::user()->phone }} <span class="fw-normal">({{ Auth::user()->alamat }})</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h2>Produk</h2>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas adipisci a accusantium eius ut voluptatibus ad impedit nulla, ipsa qui. Quasi temporibus eos commodi aliquid impedit amet, similique nulla.
    </section>
    <section>
        <h2>Kategori</h2>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam nemo ducimus eius, magnam error quisquam sunt voluptate labore, excepturi numquam! Alias libero optio sed harum debitis! Veniam, quia in eum.
    </section>
    <section>
        <h2>Promo</h2>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa dicta vero rerum? Eaque repudiandae architecto libero reprehenderit aliquam magnam ratione quidem? Nobis doloribus molestiae enim deserunt necessitatibus eaque quidem incidunt.
    </section>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>