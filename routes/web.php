<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers\admin;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductsController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
return view('auth.login');
});

Auth::routes();



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('invoices',InvoicesController::class);
Route::resource('section',SectionController::class);
Route::resource('product',ProductsController::class);




Route::get('/{page}',[AdminController::class,'index']);


