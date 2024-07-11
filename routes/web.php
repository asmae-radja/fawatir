<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource('sections', SectionController::class);
    Route::controller(SectionController::class)->group(function () {
        Route::get('/sections', 'index')->name('sections.index');
        Route::post('/sections/create', 'store')->name('sections.store');
        Route::patch('/sections/update', 'update')->name('sections.update');
        Route::delete('/sections/destroy', 'destroy')->name('section.destroy');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products.index');
        Route::post('/products/create', 'store')->name('products.store');
        Route::put('/products/update', 'update')->name('products.update');
        Route::delete('/products/destroy', 'destroy')->name('products.destroy');
    });

    //Route::resource('invoices', InvoiceController::class);
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoices', 'index')->name('invoices.index');
        
        Route::get('/invoices/payees', 'invoicesPayees')->name('invoices.payees');
        Route::get('/invoices/partiellementPayees', 'invoicesPartiellementPayees')->name('invoices.partiellementPayees');
        Route::get('/invoices/nonPayees', 'invoicesNonPayees')->name('invoices.nonPayees');

        Route::get('/invoices/create', 'create')->name('invoices.create');
        Route::get('/section/{id}', 'getproducts');
        Route::post('/invoices/store', 'store')->name('invoices.store');
        Route::get('/invoices/edit/{id}', 'edit');
     //   Route::put('/invoices/update', 'update')->name('invoices.update');
        Route::delete('/invoices/destroy', 'destroy')->name('invoice.destroy');
        Route::get('/invoices/{id}', 'show');
        Route::post('/invoices/payement', 'addMontant')->name('invoices.payments');
        Route::get('/invoices/{id}/generatePDF', 'generatePDF')->name('invoices.generatePDF');
    });
    Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
   

});

require __DIR__ . '/auth.php';
