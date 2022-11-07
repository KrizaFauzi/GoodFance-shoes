@extends('layouts.seller')
@section('content')

<div class="d-flex justify-content-between bg-white shadow-sm rounded-1 align-items-center py-2 px-3">
    <p class="fw-bold my-auto" style="font-size: 23px;">Daftar Pesanan Anda</p>
</div>

<div class="table-responsive bg-white shadow-sm rounded-1 mt-3">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Produk</th>
                <th scope="col">Alamat Pengiriman</th>
                <th scope="col">Jasa Pengiriman</th>
                <th scope="col">Nomor Pesanan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">
                    <div class="card border-0" style="max-width: 300px;">
                        <div class="row g-0">
                            <div class="col-4 col-md-4">
                                <img src="https://www.highsnobiety.com/static-assets/thumbor/a_omr90ISRWZdfHNXGFBuXQiFi8=/1600x1067/www.highsnobiety.com/static-assets/wp-content/uploads/2022/04/04162757/top-balenciaga-shoes-03.jpg"
                                    class="img-thumbnail rounded float-start" alt="...">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="card-body p-0 ps-2">
                                    <p class="card-title mb-0 lh-sm" 
                                    style="
                                    font-size: 15px; 
                                    overflow: hidden; 
                                    text-overflow: ellipsis; 
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2; /* number of lines to show */
                                    line-clamp: 2; 
                                    -webkit-box-orient: vertical;
                                    ">
                                        Nama Barang Yang Dipesandsdasdaddadasdasdadadadas
                                    </p>
                                    <p class="card-text">1 x Rp. 50.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </th>
                <td>Malang</td>
                <td>J&T Express</td>
                <td>2123787846121603</td>
            </tr>
            <tr>
                <th scope="row">
                    <div class="card border-0" style="max-width: 300px;">
                        <div class="row g-0">
                            <div class="col-4 col-md-4">
                                <img src="https://www.highsnobiety.com/static-assets/thumbor/a_omr90ISRWZdfHNXGFBuXQiFi8=/1600x1067/www.highsnobiety.com/static-assets/wp-content/uploads/2022/04/04162757/top-balenciaga-shoes-03.jpg"
                                    class="img-thumbnail rounded float-start" alt="...">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="card-body p-0 ps-2">
                                    <p class="card-title mb-0 lh-sm" 
                                    style="
                                    font-size: 15px; 
                                    overflow: hidden; 
                                    text-overflow: ellipsis; 
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2; /* number of lines to show */
                                    line-clamp: 2; 
                                    -webkit-box-orient: vertical;
                                    ">
                                        Nama Barang Yang Dipesandsdasdaddadasdasdadadadas
                                    </p>
                                    <p class="card-text">1 x Rp. 50.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </th>
                <td>Yogyakarta</td>
                <td>JNE Express</td>
                <td>2123787846121603</td>
            </tr>
            <tr>
                <th scope="row">
                    <div class="card border-0" style="max-width: 300px;">
                        <div class="row g-0">
                            <div class="col-4 col-md-4">
                                <img src="https://www.highsnobiety.com/static-assets/thumbor/a_omr90ISRWZdfHNXGFBuXQiFi8=/1600x1067/www.highsnobiety.com/static-assets/wp-content/uploads/2022/04/04162757/top-balenciaga-shoes-03.jpg"
                                    class="img-thumbnail rounded float-start" alt="...">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="card-body p-0 ps-2">
                                    <p class="card-title mb-0 lh-sm" 
                                    style="
                                    font-size: 15px; 
                                    overflow: hidden; 
                                    text-overflow: ellipsis; 
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2; /* number of lines to show */
                                    line-clamp: 2; 
                                    -webkit-box-orient: vertical;
                                    ">
                                        Nama Barang Yang Dipesandsdasdaddadasdasdadadadas
                                    </p>
                                    <p class="card-text">1 x Rp. 50.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </th>
                <td>Jakarta</td>
                <td>SiCepat Express</td>
                <td>2123787846121603</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
