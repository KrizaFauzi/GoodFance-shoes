<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaftarEventController;
use App\Http\Controllers\SlideshowController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\CartDetailController;
use App\Http\Controllers\ProdukPromoController;
use App\Http\Controllers\PromotedProdukController;
use App\Http\Controllers\EventController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomePageController::class,'index']);
Route::get('/about', [\App\Http\Controllers\HomePageController::class,'about']);
Route::get('/kontak', [\App\Http\Controllers\HomePageController::class,'kontak']);
Route::get('/category', [\App\Http\Controllers\HomePageController::class,'kategori']);
Route::get('/category/{slug}', [\App\Http\Controllers\HomepageController::class,'kategoribyslug']);
Route::get('/produk', [\App\Http\Controllers\HomepageController::class,'produk']);
Route::get('/produk/{id}', [\App\Http\Controllers\HomepageController::class,'produkdetail']);
Route::post('/search',[\App\Http\Controllers\HomepageController::class,'searching']);
Route::get('/all', [\App\Http\Controllers\HomepageController::class,'allProduk']);

Route::group(['prefix' => 'admin','middleware'=>['auth','CekLevel:admin']], function() {
    Route::get('/', [\App\Http\Controllers\DashboardController::class,'index']);
    Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
    Route::resource('event', \App\Http\Controllers\EventController::class);
    Route::post('promos/{id}', [\App\Http\Controllers\EventController::class,'storeIt'])->name('promos.store');
    Route::delete('promos/{id}', [\App\Http\Controllers\EventController::class,'destroyIt'])->name('promos.destroy');
    Route::get('image', [\App\Http\Controllers\ImageController::class,'index'])->name('image.index');
    Route::delete('image/{id}', [\App\Http\Controllers\ImageController::class,'destroy'])->name('image.destroy');
    Route::resource('slideshow',\App\Http\Controllers\SlideshowController::class);
});

Route::group(['prefix' => 'seller','middleware'=> ['auth','CekLevel:seller']], function() {
    Route::get('/', [\App\Http\Controllers\DashboardController::class,'index']);
    Route::get('profil', [\App\Http\Controllers\UserController::class,'index']);
    Route::get('setting', [\App\Http\Controllers\UserController::class,'setting']);
    Route::resource('promoted_produk', \App\Http\Controllers\PromotedProdukController::class);
    Route::resource('produk', \App\Http\Controllers\ProdukController::class);
    Route::resource('customer', \App\Http\Controllers\CustomerController::class);
    Route::get('events', [\App\Http\Controllers\DaftarEventController::class, 'all']);
    Route::get('daftar_event/{event_id}', [\App\Http\Controllers\DaftarEventController::class, 'index']);
    Route::get('detail_event/{event_id}', [\App\Http\Controllers\DaftarEventController::class, 'detail']);
    Route::post('daftar_event/{event_id}', [\App\Http\Controllers\DaftarEventController::class, 'store']);
    Route::post('produkimage',[\App\Http\Controllers\ProdukController::class,'uploadimage']);
    Route::delete('produkimage/{id}', [\App\Http\Controllers\ProdukController::class,'deleteimage']);
    Route::resource('promo',\App\Http\Controllers\ProdukPromoController::class);
    Route::get('loadprodukasync/{idproduk}/{idpromo}', [\App\Http\Controllers\ProdukController::class,'loadasync']);
    Route::get('subtotal/{harga}/{qty}', [\App\Http\Controllers\CartController::class,'subtotal']);
});

Route::group(['middleware'=>'auth'], function() {
    Route::get('laporan', [\App\Http\Controllers\LaporanController::class,'index']);
    Route::get('proseslaporan', [\App\Http\Controllers\LaporanController::class,'proses']);
    Route::resource('transaksi', \App\Http\Controllers\TransaksiController::class);
    Route::resource('cart', App\Http\Controllers\CartController::class);
    Route::delete('cart', [App\Http\Controllers\CartController::class, 'kosongkan'])->name('cart.kosongkan');
    Route::resource('cartdetail', App\Http\Controllers\CartDetailController::class);
    Route::resource('alamatpengiriman', \App\Http\Controllers\AlamatPengirimanController::class);
    Route::resource('checkout', App\Http\Controllers\CheckoutController::class);
    Route::patch('kosongkan/{id}', [\App\Http\Controllers\CartController::class,'kosongkan']);
    Route::resource('wishlist', App\Http\Controllers\WishlistController::class);
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::view('/cart_detail', 'cart_detail');
Route::view('/account', 'account_set');
Route::view('/dash', 'new_dash');
Route::view('/checkout2', 'checkout');