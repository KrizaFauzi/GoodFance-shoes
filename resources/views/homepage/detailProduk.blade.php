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
        width: 45px;
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
        width: 150px;
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
        justify-content: space-between;
    }
    .small-img-col{
        flex-basis: 24%;
        cursor: pointer;
    }
</style>
<div class="contain container mt-4">
    <div class="row" >
        <div class="col-lg-5 col-md-12 col-4" >
            <img class="img-fluid w-100 pb-1" id="main-img" src="{{ asset('img/photo3.jpg') }}" alt="">
            <div class="small-img-group">
                <div class="small-img-col">
                    <img class="small-img" width="100%" onclick="index(0)" src="{{ asset('img/avatar2.png') }}" alt="">
                </div>
                <div class="small-img-col ">
                    <img class="small-img" width="100%" onclick="index(1)" src="{{ asset('img/avatar3.png') }}" alt="">
                </div>
                <div class="small-img-col ">
                    <img class="small-img" width="100%" onclick="index(2)" src="{{ asset('img/avatar4.png') }}" alt="">
                </div>
                <div class="small-img-col ">
                    <img class="small-img" width="100%" onclick="index(3)" src="{{ asset('img/avatar2.png') }}" alt="">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-8" >
            <h6 class="py-4">Category / T-Shirt</h6>
            <h3 class="fw-bold">Men's Fashion and Louis</h3>
            <h2>Rp. 300.000</h2>
            <form action="">
                <select class="my-3" name="" id="">
                    <option value="">Pilih Ukuran</option>
                    <option value="">S</option>
                    <option value="">M</option>
                    <option value="">L</option>
                    <option value="">X</option>
                </select>
                <input class="" type="number" name="qty" value="1" min="1" max="10">
                <button type="submit" class="btn-cart">Add To Cart</button>
            </form>
            <h4 class="mt-5 mb-3 fw-semibold">Product Detail</h4>
            <span class="content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga tempore numquam maiores? Aut exercitationem quidem laboriosam fugit delectus praesentium? Molestiae nulla voluptas recusandae sint voluptate unde maiores facilis animi quidem.</span>
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