<?php

use App\Models\Kategori;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\OrderDetailController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[FrontController::class,'index']);
Route::get('show/{id}', [FrontController::class, 'show']);
Route::get('register', [FrontController::class, 'register']);

Route::get('login', [FrontController::class, 'login']);
Route::get('logout', [FrontController::class, 'logout']);

Route::post('postlogin', [FrontController::class, 'postlogin']);
Route::post('postregister', [FrontController::class, 'store']);

Route::get('beli/{idmenu}',[CartController::class,'beli']);
Route::get('hapus/{idmenu}',[CartController::class,'hapus']);
Route::get('tambah/{idmenu}',[CartController::class,'tambah']);
Route::get('kurang/{idmenu}',[CartController::class,'kurang']);

Route::get('cart',[CartController::class,'cart']);
Route::get('batal',[CartController::class,'batal']);
Route::get('checkout',[CartController::class,'checkout']);

Route::get('admin',[AuthController::class,'index']);
Route::get('admin/logout',[AuthController::class,'logout']);
Route::post('admin/postlogin',[AuthController::class,'postlogin']);

  
Route::group(['prefix'=>'admin','middleware'=>['auth'] ],function(){
   
    
    
Route::group(['middleware'=>['Ceklogin:admin']],function(){
    Route::resource('user',UserController::class);
});
Route::group(['middleware'=>['Ceklogin:kasir']],function(){
    Route::resource('order',OrderController::class);
});
Route::group(['middleware'=>['Ceklogin:manager']],function(){
    Route::resource('kategori',KategoriController::class);
    Route::resource('menu',MenuController::class);
    Route::resource('order',OrderController::class);
    Route::resource('orderdetail',OrderDetailController::class);
    Route::resource('pelanggan',PelangganController::class);
    Route::get('select',[MenuController::class,'select']);
    Route::post('postmenu/{id}',[MenuController::class,'Update']);

});

});