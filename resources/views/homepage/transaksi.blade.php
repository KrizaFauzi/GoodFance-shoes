@extends('layouts.template')
@section('content')
<style>
    .contain{
        min-height: 74vh;
    }
</style>
<div class="contain container">
    <div class="my-3">
        @if ($message = Session::get('error'))
            <div class="alert alert-warning">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
    @if (isset($belumDibayar))
        <a class="text-decoration-none" href="{{ route('order.pay', $belumDibayar->id) }}">
            <div class="border border-dark border-2 bg-white p-3 rounded text-dark" >
                Orderan kamu masih belum dibayar nih, bayar dulu yaa
            </div>
        </a>   
    @endif
    <div class="btn-group d-flex flex-wrap shadow-none mt-2 mt-lg-2 mt-md-2 mt-xl-2 ms-2 ms-lg-2 ms-md-2 ms-xl-2" >
        <ul class="nav nav-pills" id="myTab" role="tablist">
            <li>
                <h3 class="mt-1 fw-semibold">Status</h3>
            </li>
            <li class="nav-item" role="presentation">
                <button data-bs-toggle="pill" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true" style="width: 150px; font-size: 13px;" class="btn btn-outline-secondary rounded-3 active align-self-center mt-1 mt-lg-1 mt-md-1 mt-xl-1 mx-2 mx-lg-2 mx-md-2 mx-xl-2 rounded">
                    All
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button data-bs-toggle="pill" data-bs-target="#menunggu" type="button" role="tab" aria-controls="menunggu" aria-selected="false" style="width: 150px; font-size: 13px;" class="btn btn-outline-secondary rounded-3 align-self-center mt-1 mt-lg-1 mt-md-1 mt-xl-1 mx-2 mx-lg-2 mx-md-2 mx-xl-2 rounded" >
                    Menunggu
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button data-bs-toggle="pill" data-bs-target="#diproses" type="button" role="tab" aria-controls="diproses" aria-selected="false" style="width: 150px; font-size: 13px;" class="btn btn-outline-secondary rounded-3 align-self-center mt-1 mt-lg-1 mt-md-1 mt-xl-1 mx-2 mx-lg-2 mx-md-2 mx-xl-2 rounded" >
                    Diproses
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button data-bs-toggle="pill" data-bs-target="#dikirim" type="button" role="tab" aria-controls="dikirim" aria-selected="false" style="width: 150px; font-size: 13px;" class="btn btn-outline-secondary rounded-3 align-self-center mt-1 mt-lg-1 mt-md-1 mt-xl-1 mx-2 mx-lg-2 mx-md-2 mx-xl-2 rounded" >
                    Dikirim
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button data-bs-toggle="pill" data-bs-target="#tiba" type="button" role="tab" aria-controls="tiba" aria-selected="false" style="width: 150px; font-size: 13px;" class="btn btn-outline-secondary rounded-3 align-self-center mt-1 mt-lg-1 mt-md-1 mt-xl-1 mx-2 mx-lg-2 mx-md-2 mx-xl-2 rounded" >
                    Tiba Ditujuan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button data-bs-toggle="pill" data-bs-target="#dibatalkan" type="button" role="tab" aria-controls="dibatalkan" aria-selected="false" style="width: 150px; font-size: 13px;" class="btn btn-outline-secondary rounded-3 align-self-center mt-1 mt-lg-1 mt-md-1 mt-xl-1 mx-2 mx-lg-2 mx-md-2 mx-xl-2 rounded" >
                    Dibatalkan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button data-bs-toggle="pill" data-bs-target="#ditolak" type="button" role="tab" aria-controls="ditolak" aria-selected="false" style="width: 150px; font-size: 13px;" class="btn btn-outline-secondary rounded-3 align-self-center mt-1 mt-lg-1 mt-md-1 mt-xl-1 mx-2 mx-lg-2 mx-md-2 mx-xl-2 rounded" >
                    Ditolak
                </button>
            </li>
        </ul>       
    </div>

    <div class="tab-content mt-5" id="pills-tabContent">        
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all" tabindex="0">
            <!-- All -->
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Invoice</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Status</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Tanggal Dipesan</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($all as $all)
                    <tr>
                        <td>{{ $all->invoice }}</td>
                        <td>{{ $all->nama_produk }}</td>
                        <td>{{ $all->status }}</td>
                        <td>{{ $all->harga }}</td>
                        <td>{{ $all->qty }}</td>
                        <td>{{ $all->total }}</td>
                        <td>{{ $all->created_at }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ URL::to('produk/'.$all->cart->produk->slug_produk ) }}">Detail</a>
                        </td>
                      </tr>  
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="tab-pane fade" id="menunggu" role="tabpanel" aria-labelledby="menunggu" tabindex="0">
            
            <!-- Menunggu -->
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Invoice</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Status</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Tanggal Dipesan</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($menunggu as $menunggu)
                        <tr>
                            <td>{{ $menunggu->invoice }}</td>
                            <td>{{ $menunggu->nama_produk }}</td>
                            <td>{{ $menunggu->status }}</td>
                            <td>{{ $menunggu->harga }}</td>
                            <td>{{ $menunggu->qty }}</td>
                            <td>{{ $menunggu->total }}</td>
                            <td>{{ $menunggu->created_at }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ URL::to('produk/'.$menunggu->cart->produk->slug_produk ) }}">Detail</a>
                                <form action="{{ route('order.batal', $menunggu->id) }}" method="post" style="display:inline;">
                                @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Batalkan
                                    </button>                    
                                </form>
                            </td>
                      </tr>  
                    @endforeach
                </tbody>
              </table>
            
        </div>
        <div class="tab-pane fade" id="diproses" role="tabpanel" aria-labelledby="diproses" tabindex="0">
            
            <!-- Diproses -->
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Invoice</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Status</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Tanggal Dipesan</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($diproses as $diproses)
                        <tr>
                            <td>{{ $diproses->invoice }}</td>
                            <td>{{ $diproses->nama_produk }}</td>
                            <td>{{ $diproses->status }}</td>
                            <td>{{ $diproses->harga }}</td>
                            <td>{{ $diproses->qty }}</td>
                            <td>{{ $diproses->total }}</td>
                            <td>{{ $diproses->created_at }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ URL::to('produk/'.$diproses->cart->produk->slug_produk ) }}">Detail</a>
                                <form action="{{ route('order.batal', $diproses->id) }}" method="post" style="display:inline;">
                                @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Batalkan
                                    </button>                    
                                </form>
                            </td>
                        </tr>  
                    @endforeach
                </tbody>
              </table>
            
        </div>
        <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim" tabindex="0">
            
            <!-- Dikirim -->
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Invoice</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Status</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Tanggal Dipesan</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($dikirim as $dikirim)
                        <tr>
                            <td>{{ $dikirim->invoice }}</td>
                            <td>{{ $dikirim->nama_produk }}</td>
                            <td>{{ $dikirim->status }}</td>
                            <td>{{ $dikirim->harga }}</td>
                            <td>{{ $dikirim->qty }}</td>
                            <td>{{ $dikirim->total }}</td>
                            <td>{{ $dikirim->created_at }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ URL::to('produk/'.$dikirim->cart->produk->slug_produk ) }}">Detail</a>
                                <form action="{{ route('order.batal', $dikirim->id) }}" method="post" style="display:inline;">
                                @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Batalkan
                                    </button>                    
                                </form>
                            </td>
                        </tr>  
                    @endforeach
                </tbody>
              </table>
        
        </div>
        <div class="tab-pane fade" id="tiba" role="tabpanel" aria-labelledby="tiba" tabindex="0">
            
            <!-- Tiba -->
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Invoice</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Status</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Tanggal Dipesan</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($tiba as $tiba)
                        <tr>
                            <td>{{ $tiba->invoice }}</td>
                            <td>{{ $tiba->nama_produk }}</td>
                            <td>{{ $tiba->status }}</td>
                            <td>{{ $tiba->harga }}</td>
                            <td>{{ $tiba->qty }}</td>
                            <td>{{ $tiba->total }}</td>
                            <td>{{ $tiba->created_at }}</td>
                            <td>
                                <form action="{{ route('order.diterima', $tiba->id) }}" method="post" style="display:inline;">
                                @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Diterima
                                    </button>                    
                                </form>
                            </td>
                        </tr>  
                @endforeach
                </tbody>
              </table>

        </div>
        <div class="tab-pane fade" id="dibatalkan" role="tabpanel" aria-labelledby="dibatalkan" tabindex="0">
            
            <!-- Dibatalkan -->
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Invoice</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Status</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Tanggal Dipesan</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($dibatalkan as $dibatalkan)
                        <tr>
                            <td>{{ $dibatalkan->invoice }}</td>
                            <td>{{ $dibatalkan->nama_produk }}</td>
                            <td>{{ $dibatalkan->status }}</td>
                            <td>{{ $dibatalkan->harga }}</td>
                            <td>{{ $dibatalkan->qty }}</td>
                            <td>{{ $dibatalkan->total }}</td>
                            <td>{{ $dibatalkan->created_at }}</td>
                            <td><a class="btn btn-primary" href="">Detail</a></td>
                        </tr>  
                    @endforeach
                </tbody>
              </table>

        </div>
        <div class="tab-pane fade" id="ditolak" role="tabpanel" aria-labelledby="ditolak" tabindex="0">
            
            <!-- Ditolak -->
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Invoice</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Status</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Tanggal Dipesan</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($ditolak as $ditolak)
                        <tr>
                            <td>{{ $ditolak->invoice }}</td>
                            <td>{{ $ditolak->nama_produk }}</td>
                            <td>{{ $ditolak->status }}</td>
                            <td>{{ $ditolak->harga }}</td>
                            <td>{{ $ditolak->qty }}</td>
                            <td>{{ $ditolak->total }}</td>
                            <td>{{ $ditolak->created_at }}</td>
                            <td>
                                <a href="{{ URL::to('produk/'. $ditolak->cart->produk->slug_produk ) }}" class="btn btn-sm btn-success">Pesan Lagi</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>

        </div>
    </div>
</div>

@endsection

