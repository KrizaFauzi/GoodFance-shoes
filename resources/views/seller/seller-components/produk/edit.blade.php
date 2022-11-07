@extends('layouts.seller')
@section('content')

<style>
    .photos-row {
        display: flex;
        color: #fff;
        flex-wrap: wrap;
    }

    .photos-row input {
        display: flex;
        flex-direction: column;
        visibility: hidden;
        position: absolute;
        z-index: -1;
    }

    .photo-input-box {
        background-color: transparent;
        border-radius: 20px;
        position: relative;
        overflow: hidden;
        width: 140px;
        margin-bottom: 10px;
        height: 140px;
        margin-right: 10px;
        border: 2px dashed #cfcfcf;
    }

    .photo-camp-box {
        position: relative;
        height: 100%;
    }

    .photo-camp {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: -10;
        pointer-events: none;
        width: 100%;
        height: 100%;
    }

    .photo-label {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    textarea:focus,
    .select-kategori:focus,
    input[type="text"]:focus,
    .deskripsi:focus {
        border-color: rgba(0, 238, 255, 0.8);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(0, 238, 255, 0.6);
        outline: 0 none;
    }

</style>

<!-- Text Tambah Produk -->
<div class="d-flex justify-content-between bg-white shadow-sm rounded-1 align-items-center py-2 px-3">
    <p class="fw-bold my-auto" style="font-size: 23px;">Tambah Produk</p>
</div>
<!-- End Text Tambah Produk -->

<!-- Image Input -->
<div class="bg-white shadow-sm rounded-1 p-3 mt-2">
    <p class="fw-bold" style="font-size: 19px;">Foto Produk</p>
    <div class="photos-row">
        <div class="photo-input-box">
            <div class="photo-camp-box">
                <img src="https://dummyimage.com/600x400/000/fff" alt="" class="photo-camp" />
                <label for="foto1" class="photo-label d-flex align-items-center"
                    style="height: 100%; width: 100%; cursor: pointer;">

                    <span class="m-auto">
                        <p style="font-size: 13px; color: black; font-weight: 500;">Upload your image</p>
                    </span>
                    <span class="checked-photo"></span>
                </label>
                <input type="file" name="Foto1" id="foto1" accept="image/*;capture=camera" />
            </div>
        </div>

        <div class="photo-input-box">
            <div class="photo-camp-box">
                <img src="https://dummyimage.com/600x400/000/fff" alt="" class="photo-camp" />

                <label for="foto2" class="photo-label d-flex align-items-center"
                    style="height: 100%; width: 100%; cursor: pointer;">
                    <span class="m-auto">
                        <p style="font-size: 13px; color: black; font-weight: 500;">Upload your image</p>
                    </span>
                    <span class="checked-photo"></span>
                </label>
                <input type="file" name="Foto2" id="foto2" accept="image/*;capture=camera" />
            </div>
        </div>

        <div class="photo-input-box">
            <div class="photo-camp-box">
                <img src="https://dummyimage.com/600x400/000/fff" alt="" class="photo-camp" />

                <label for="foto3" class="photo-label d-flex align-items-center"
                    style="height: 100%; width: 100%; cursor: pointer;">
                    <span class="m-auto">
                        <p style="font-size: 13px; color: black; font-weight: 500;">Upload your image</p>
                    </span>
                    <span class="checked-photo"></span>
                </label>
                <input type="file" name="Foto3" id="foto3" accept="image/*;capture=camera" />
            </div>
        </div>
    </div>
</div>
<!-- End Image Input -->

<div class="bg-white shadow-sm rounded-1 p-3 mt-2">
    <div class="row g-0 g-lg-3 align-items-center">
        <div class="col-6 col-md-2">
            <label for="namaProduk" class="col-form-label fw-semibold" style="font-size: 15px;">
                Nama Produk
            </label>
        </div>
        <div class="col-sm-6 col-md-10">
            <input type="text" id="namaProduk" class="form-control">
        </div>

        <div class="col-6 col-md-2">
            <label for="kategoriProduk" class="col-form-label fw-semibold" style="font-size: 15px;">
                Kategori Produk
            </label>
        </div>
        <div class="col-sm-6 col-md-10">
            <select class="form-select select-kategori" aria-label="Default select example">
                <option selected disabled>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>

        <div class="col-6 col-md-2">
            <label for="deskripsiProduk" class="col-form-label fw-semibold" style="font-size: 15px;">
                Deskripsi Produk
            </label>
        </div>
        <div class="col-sm-6 col-md-10">
            <textarea class="form-control deskripsi" id="deskripsiProduk" rows="4"></textarea>
        </div>

        <div class="col-6 col-md-2">
            <label for="jumlahProduk" class="col-form-label fw-semibold" style="font-size: 15px;">
                Jumlah Barang
            </label>
        </div>
        <div class="col-sm-6 col-md-10">
            <input type="text" id="jumlahProduk" class="form-control">
        </div>

        <div class="col-6 col-md-2">
            <label for="hargaProduk" class="col-form-label fw-semibold" style="font-size: 15px;">
                Harga Barang
            </label>
        </div>
        <div class="col-sm-6 col-md-10">
            <input type="text" id="hargaProduk" class="form-control">
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-info fw-bold text-light px-5" style="font-size: 15px;">
                Submit
            </button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $('input[type="file"]').on("change", function () {
        var iconString = '<i class="fas fa-check"></i>';
        var span = $(this)
            .closest(".photo-input-box")
            .find(".checked-photo");

        if ($(this).get(0).files.length !== 0) {
            $(span).html(iconString);
        } else {
            $(span).html("");
        }
    });

    $('input[type="file"]').on("change", function () {
        var img = $(this)
            .closest(".photo-input-box")
            .find(".photo-camp");
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                img.attr("src", e.target.result);
                img.css("zIndex", 10);
            };

            reader.readAsDataURL(this.files[0]);
        } else {
            img.css("zIndex", -10);
        }
    });

</script>

@endsection
