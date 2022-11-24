<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title> Home </title>
    <style>
        .txt{
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
                line-clamp: 1; 
        -webkit-box-orient: vertical;
      }
      .tales {
        width: 100%;
      }
      .carousel-inner{
        width: 100%;
        max-height: 300px !important;
        border-radius: 25px 25px 25px 25px;
      }
      .form-control:focus {
        border-color: #0f3c4c;
        box-shadow: 0 0 0 0 rgba(147, 147, 147, 0.8);
      }
      .form-select:focus {
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
      .btn-ubah:hover{
        text-decoration: underline;
      }
      @media (min-width: 992px) {
        .card-3{
          margin-top: -50px;
        }
      }
      @media (min-width: 576px) {
        .card-2{
          width: 100%;
        }
      }
    </style>
  </head>
  <body>
    <!-- menunya kita taruh persis di bawah <body> -->
    @include('layouts.menu')
    <!-- di bawah menu baru kontennya -->

    <!-- Mulai sini kontennya depannya kasih @ sama yield-->
    @yield('content')
    <!-- Sampai sini -->

    @include('layouts.footer')
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script>
      $(document).click(function(event) {
        if(
          $('.toggle > input').is(':checked') &&
          !$(event.target).parents('.toggle').is('.toggle')
        ) {
          $('.toggle > input').prop('checked', false);
        }
      });
    </script>
  </body>
</html>