<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Cart Page</title>
    <style>
        .form-control:focus {
            border-color: #0f3c4c;
            box-shadow: 0 0 0 0.2rem rgba(147, 147, 147, 0.8);
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
        img{
            object-fit: cover;
            width: 90%;
            height: 90vh;
        }
    </style>
</head>
<body>
    @include('layouts.menu')
    @guest
    <div class="mt-2 pb-2 bg-light" style="margin-left: 55px; margin-right: 50px;">
        <div class="mx-3">
            <h2 class="pt-3">Shopping Cart</h2>
            <p class="fw-normal fs-6 fst-italic">Your cart is empty.</p>
            <hr>
            <div style="align-items: center;" class="btn-group row row-cols-1 row-cols-lg-2 shadow-none mt-2 mt-lg-0 mt-md-0 mt-xl-0">
                <a style="width: 200px; font-size: 14px;" href="{{ route('login') }}" class="btn btn-outline-dark btn-sm align-self-center mx-2 mx-lg-3 mx-md-2 mx-xl-3 rounded fw-semibold">Sign in to your account</a>
                <a style="width: 120px; font-size: 14px;" href="{{ route('register') }}" class="btn btn-dark btn-sm align-self-center mt-1 mt-lg-0 mt-md-0 mt-xl-0 mx-2 mx-lg-0 mx-md-0 mx-xl-0 rounded fw-semibold">Sign up now</a>
            </div>
            <hr>
        </div>
    </div>
    @endguest
    
    @auth
        <img  class="" src="{{ asset('img/WKS.png') }}" alt="">
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
