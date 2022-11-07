@extends('layouts.seller')
@section('content')
    
<div class="row row-cols-1 row-cols-lg-4">
    <div class="col mb-2 mb-lg-0">
        <div class="card text-center h-100">
            <div class="card-body">
                <h5 class="card-title">Pesanan Baru</h5>
                <hr class="mt-3 mb-0">
                <p class="card-text fs-3 fw-bold">0</p>
            </div>
        </div>
    </div>

    <div class="col mb-2 mb-lg-0">
        <div class="card text-center h-100">
            <div class="card-body">
                <h5 class="card-title">Jumlah Produk</h5>
                <hr class="mt-3 mb-0">
                <p class="card-text fs-3 fw-bold">0</p>
            </div>
        </div>
    </div>

    <div class="col mb-2 mb-lg-0">
        <div class="card text-center h-100">
            <div class="card-body">
                <h5 class="card-title">Pengiriman Perlu Diproses</h5>
                <hr class="mt-3 mb-0">
                <p class="card-text fs-3 fw-bold">0</p>
            </div>
        </div>
    </div>

    <div class="col mb-2 mb-lg-0">
        <div class="card text-center d-flex align-items-center h-100">
            <div class="card-body">
                <h5 class="card-title">Pengiriman Telah Diproses</h5>
                <hr class="mt-3 mb-0">
                <p class="card-text fs-3 fw-bold">0</p>
            </div>
        </div>
    </div>
</div>
@endsection
