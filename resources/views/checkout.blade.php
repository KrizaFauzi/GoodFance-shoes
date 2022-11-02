@extends('layouts.template')
@section('content')

<div class="container-fluid px-md-5">
    <h2 class="fw-bold mt-3">Checkout</h2>
    <div class="row row-cols-1 ">
        <div class="col-sm-6 col-md-8 mt-1">
            <div class="card card-1">
                <h6 class="d-flex p-3 fw-bold mb-0 pb-0" style="font-size: 16px;">
                    Alamat Penerima
                    <span class="ms-auto">
                        <button type="button" class="btn btn-ubah m-0 p-0 text-primary fw-semibold border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ubah</button>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 fw-semibold" id="staticBackdropLabel">Alamat Penerima</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nomor Telepon</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Detail Alamat Lainnya</label>
                                                <input type="text" class="form-control" placeholder="Apartment, studio, or floor">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="inputCity" class="form-label">Kota</label>
                                                <input type="text" class="form-control" id="inputCity">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Provinsi</label>
                                                <select class="form-select">
                                                    <option selected>Choose...</option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Kode Pos</label>
                                                <input type="text" class="form-control" id="inputZip">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Tandai Sebagai</label>
                                                <div class="row row-cols-2">
                                                    <div class="col">
                                                        <div class="form-check">
                                                            <input class="form-check-input mt-0" type="radio" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Rumah">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Rumah
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-check">
                                                            <input class="form-check-input mt-0" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Kantor">
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                Kantor
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </span>
                </h6>
                <hr>
                <div class="card-body pt-0">
                    <div class="border border-1 bg-light p-2 pb-0">
                        <p class="fw-bold mb-0" style="font-size: 15.5px;">
                            Nama Penerima <span>(No. Telpon)</span>
                        </p>
                        <p style="font-size: 15.5px;" class="fw-bold mb-2">Alamat Pengirim</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col col-md-4 mt-1">
            <div class="card card-2">
                <h6 class="p-3 fw-bold mb-0 pb-0" style="font-size: 16px;">
                    Produk Dipesan
                </h6><hr class="my-2">
                <div class="card-body p-0 m-0">
                    <div class="container">
                        <p class="fw-semibold m-0">Nama Produk :</p>
                        <p class="fw-semibold m-0">Subtotal :</p>
                        <p class="fw-semibold m-0">Discount :</p>
                        <hr class="my-1">
                        <p class="fw-semibold fs-4 m-0">Total : Rp. </p>
                        <hr class="my-0">
                        <div class="d-grid">
                            <button type="button" class="btn btn-warning fw-semibold my-2">Buat Pesanan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-8 mt-1">
            <div class="card card-3">
                <h6 class="p-3 fw-bold mb-0 pb-0" style="font-size: 16px;">
                    Metode Pembayaran
                </h6>
                <hr>
                <div class="card-body pt-0">
                    <div>
                        <div class="form-check fw-semibold">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            COD (Cash On Delivery)
                            </label>
                        </div>
                        <div class="accordion mt-2">
                            <div class="accordion-item">
                                <div style="font-size: 15px;" class="container fw-semibold bg-light py-2 accordion-header d-flex align-items-center">
                                    Transfer Bank
                                </div>
                                <div class="accordion-body bg-white py-2">
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Bank BCA">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Bank BCA
                                        </label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Bank Mandiri">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Bank Mandiri
                                        </label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Bank BNI">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Bank BNI
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Bank BRI">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Bank BRI
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection