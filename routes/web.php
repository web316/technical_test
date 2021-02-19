<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvoiceController;

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

Route::get('/', [InvoiceController::class, 'index'])->name('invoices');

Route::prefix('invoices')->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('invoices');
    Route::post('/', [InvoiceController::class, 'search'])->name('invoices.search');
    Route::get('/locations', [InvoiceController::class, 'locations'])->name('invoices.locations');
    Route::post('/locations', [InvoiceController::class, 'locationSearch'])->name('invoices.locations.search');
});