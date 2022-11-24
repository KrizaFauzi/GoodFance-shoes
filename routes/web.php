<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LupaPassword;
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
Route::get('/slide/{id}', [HomepageController::class, 'slide'])->name('slide.show');
Route::get('/category/{slug}', [\App\Http\Controllers\HomepageController::class,'kategoribyslug']);
Route::get('/produk', [\App\Http\Controllers\HomepageController::class,'produk']);
Route::get('/produk/{id}', [\App\Http\Controllers\HomepageController::class,'produkdetail'])->name('produk.detail');
Route::post('/search',[\App\Http\Controllers\HomepageController::class,'searching']);
Route::get('/all', [\App\Http\Controllers\HomepageController::class,'allProduk']);
Route::get('/toko/{id}', [HomePageController::class, 'toko'])->name('homepage.toko');
Route::get('forget-password', [LupaPassword::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [LupaPassword::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [LupaPassword::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [LupaPassword::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::group(['prefix' => 'admin','middleware'=>['auth','CekLevel:admin']], function() {
    Route::get('/', [\App\Http\Controllers\DashboardController::class,'index']);
    Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
    Route::resource('event', \App\Http\Controllers\EventController::class);
    Route::post('promos/{id}', [\App\Http\Controllers\EventController::class,'storeIt'])->name('promos.store');
    Route::delete('promos/{id}', [\App\Http\Controllers\EventController::class,'destroyIt'])->name('promos.destroy');
    Route::get('image', [\App\Http\Controllers\ImageController::class,'index'])->name('image.index');
    Route::delete('image/{id}', [\App\Http\Controllers\ImageController::class,'destroy'])->name('image.destroy');
    Route::get('order', [DashboardController::class, 'adminOrder'])->name('order.adminOrder');
    Route::post('kirim/{id}', [DashboardController::class, 'kirim'])->name('order.kirim');
    Route::get('ekspedisi', [DashboardController::class, 'ekspedisiOrder'])->name('order.ekspedisi');
    Route::post('tiba/{id}', [DashboardController::class, 'tiba'])->name('order.tiba');
    Route::resource('slideshow',\App\Http\Controllers\SlideshowController::class);
    Route::resource('about',\App\Http\Controllers\AboutController::class);
});

Route::group(['prefix' => 'seller','middleware'=> ['auth','CekLevel:seller']], function() {
    Route::get('/', [\App\Http\Controllers\DashboardController::class,'index']);
    Route::get('profil', [\App\Http\Controllers\UserController::class,'index']);
    Route::get('setting', [\App\Http\Controllers\UserController::class,'setting']);
    Route::resource('promoted_produk', \App\Http\Controllers\PromotedProdukController::class);
    Route::resource('produk', \App\Http\Controllers\ProdukController::class);
    Route::resource('customer', \App\Http\Controllers\CustomerController::class);
    Route::get('events', [\App\Http\Controllers\DaftarEventController::class, 'all']);
    Route::get('even', [\App\Http\Controllers\DaftarEventController::class, 'event'])->name('Event.even');
    Route::get('daftar_event/{event_id}', [\App\Http\Controllers\DaftarEventController::class, 'index']);
    Route::get('detail_event/{event_id}', [\App\Http\Controllers\DaftarEventController::class, 'detail']);
    Route::post('daftar_event/{event_id}', [\App\Http\Controllers\DaftarEventController::class, 'store']);
    Route::post('produkimage',[\App\Http\Controllers\ProdukController::class,'uploadimage']);
    Route::delete('produkimage/{id}', [\App\Http\Controllers\ProdukController::class,'deleteimage']);
    Route::resource('promo',\App\Http\Controllers\ProdukPromoController::class);
    Route::get('loadprodukasync/{idproduk}/{idpromo}', [\App\Http\Controllers\ProdukController::class,'loadasync']);
    Route::get('subtotal/{harga}/{qty}', [\App\Http\Controllers\CartController::class,'subtotal']);
    Route::resource('toko', TokoController::class);
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
    Route::get('/rating/{id}', [\App\Http\Controllers\RatingController::class,'index'])->name('rating.rate');
    Route::post('/rating/{idp}', [\App\Http\Controllers\RatingController::class,'store'])->name('rating.store');
    Route::get('transaksi', [HomepageController::class, 'transaksi'])->name('homepage.transaksi');
    Route::get('history', [HomepageController::class, 'history'])->name('homepage.history');
    Route::post('terima/{id}', [DashboardController::class, 'terima'])->name('order.terima');
    Route::post('tolak/{id}', [DashboardController::class, 'tolak'])->name('order.tolak');
    Route::post('batal/{id}', [HomePageController::class, 'batal'])->name('order.batal');
    Route::post('diterima/{id}', [HomePageController::class, 'diterima'])->name('order.diterima');
    Route::get('order', [DashboardController::class, 'orderan'])->name('order.orderan');
    Route::get('orderold', [DashboardController::class, 'orderanold'])->name('order.orderanold');
    Route::patch('kosongkan/{id}', [\App\Http\Controllers\CartController::class,'kosongkan']);
    Route::resource('wishlist', App\Http\Controllers\WishlistController::class);
});

Auth::routes();
Route::get('pay', [CheckoutController::class, 'payment']);
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');