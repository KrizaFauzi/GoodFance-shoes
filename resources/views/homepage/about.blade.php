@extends('layouts.template')
@section('content')
<style>
  .contain{
    min-height: 76vh;
  }
  .ukuran{
    font-size: 1rem;
  }
</style>
<div class="contain container">
  <div class="row">
    <div class="col mt-4">
      <h1>Tentang Kami</h1>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <ul>
        <li>
            <h4 class="fw-semibold" >
              Apa itu Goodfance Shoes?
            </h4>
            <p class="ukuran">
              Goodfance Shoes adalah plaza online yang memungkinkan setiap individu dan pemilik bisnis di Indonesia untuk mengembangkan dan mengelola bisnis online mereka secara mudah dan gratis. 
              Goodfance menampung pemilik bisnis kecil hingga brand besar. Sehingga Goodfance Shoes menjadi pilihan tepat untuk member dalam memilih produk sesuai keinginan.
            </p>
        </li>
        <li>
          <h4 class="fw-semibold">
            Apa saja produk yang ada?
          </h4>
          <p class="ukuran">
            Goodfance Shoes menawarkan produk sepatu untuk kalangan muda hingga dewasa. Dan menyediakan berbagai tipe sepatu, seperti sepatu olahraga, casual, hingga tipe high heels untuk wanita.
          </p>
        </li>
        <li>
          <h4 class="fw-semibold">
            Bagaimana cara berjualan di Goodfance Shoes?
          </h4>
          <p class="ukuran">
            Anda bisa memulai dengan mendaftar sebagai Seller dengan cara registrasi di website ini. Anda akan mendapat akses untuk mengelola toko, produk, dan promo sesuai kebutuhan.
          </p>
        </li>
        <li>
          <h4 class="fw-semibold">
            Bagaimana cara membeli produk di Goodfance Shoes?
          </h4>
          <p class="ukuran">
            Langkah pertama yaitu dengan Sign Up sebagai Member. Lalu Anda akan diarahkan ke halaman Home. Silahkan pilih sepatu sesuai kebutuhan dan lakukan Checkout setelahnya.
          </p>
        </li>
      </ul>
    </div>
  </div>
</div>
@endsection