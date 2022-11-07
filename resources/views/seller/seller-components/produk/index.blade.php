@extends('layouts.seller')
@section('content')

<div class="d-flex justify-content-between bg-white shadow-sm rounded-1 align-items-center py-2 px-3">
    <p class="fw-bold my-auto" style="font-size: 23px;">Daftar Produk Anda</p>
    <a href="{{ route('produk-create') }}" class="btn btn-info fw-semibold text-white btn-sm">
        <span><i class="fa-solid fa-plus me-2"></i></span>Tambah Produk
    </a>
</div>

<div class="bg-white shadow-sm rounded-1 mt-3">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry the Bird</td>
                <td>Fathan</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection