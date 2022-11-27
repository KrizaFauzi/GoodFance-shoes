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
    </style>
</head>
<body>
    @include('layouts.menu')
    @auth
    <div class="mt-2 p-2 bg-light" style="margin-left: 55px; margin-right: 50px;">
        <h2 class="pt-3">Shopping Cart</h2>
        <div class="card-body">
            <table class="table table-stripped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Produk</th>
                  <th>Warna</th>
                  <th>Ukuran</th>
                  <th>Harga</th>
                  <th>Diskon</th>
                  <th>Qty</th>
                  <th>Subtotal</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse($itemcart as $detail)
                <tr>
                  <td>
                  {{ $no++ }}
                  </td>
                  <td>
                  {{ $detail->produk->nama_produk }}
                  <br />
                  {{ $detail->produk->kode_produk }}
                  </td>
                  <td>
                    {{ $detail->CartDetail->warna }}
                  </td>
                  <td>
                    {{ $detail->CartDetail->ukuran }}
                  </td>
                  <td>
                    {{ number_format($detail->CartDetail->harga) }}
                  </td>
                  <td>
                  @if (isset($detail->produk->promoted_produk->promo))
                      {{ number_format($detail->produk->promoted_produk->promo->diskon_persen) }}%
                    @else
                      0
                  @endif
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <form action="{{ route('cart.update',$detail->id) }}" method="post">
                      @method('patch')
                      @csrf()
                        <input type="hidden" name="param" value="kurang">
                        <button class="btn btn-primary btn-sm">
                        -
                        </button>
                      </form>
                      <button class="btn btn-outline-primary btn-sm" disabled="true">
                          {{ number_format($detail->CartDetail->qty) }}
                          <input type="hidden" id="qty" value="{{ $detail->CartDetail->qty }}">
                      </button>
                      <form action="{{ route('cart.update',$detail->id) }}" method="post">
                      @method('patch')
                      @csrf()
                        <input type="hidden" name="param" value="tambah">
                        <button class="btn btn-primary btn-sm">
                        +
                        </button>
                      </form>
                    </div>
                  </td>
                  <td>
                    {{ number_format($detail->CartDetail->total) }}
                  </td>
                  <td>
                  <form action="{{ route('cart.destroy', $detail->id) }}" method="post" style="display:inline;">
                    @csrf
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-sm btn-danger mb-2">
                      Hapus
                    </button>                    
                  </form>
                  </td>
                </tr>
                @empty
                <div>Ups Tidak ada barang di cart kamu</div>
                @endforelse
              </tbody>
            </table>
          </div>
    </div>

    <div class="bg-light rounded-bottom py-4 mt-2" id="zero-pad" style="margin-left: 55px; margin-right: 50px;">
      <div class="row d-flex justify-content-center">
          <div class="col-lg-10 col-12">
              <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <form action="{{ route('cart.kosongkan') }}" method="post">
                      @method('delete')
                      @csrf()
                      <button type="submit" class="btn btn-warning btn-sm px-lg-5 px-1 btn-block">Kosongkan</button>
                    </form>
                  </div>
                  <div>
                    <form action="{{ route('cekout.store') }}" method="post">
                      @csrf
                        <input type="hidden" name="user_id" value="{{ auth::user()->id }}">
                        <button type="submit" class="btn btn-sm btn-info text-dark px-lg-5 px-1">Pesan</button>
                    </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
    @endauth
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
