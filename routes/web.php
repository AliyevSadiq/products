<?php


use App\Modules\products\Htpp\Controller\ProductController;
use Illuminate\Support\Facades\Route;

Route::group( [ 'namespace' => 'App\Modules\products\Http\Controller',
    'as' => 'product.',
    'middleware' => ['web']
], function(){
    Route::get('/product', [ProductController::class,'index'])->name('index');
    Route::get('/product/create', [ProductController::class,'create'])->name('create');
    Route::post('/product/create', [ProductController::class,'store'])->name('store');
    Route::get('/product/edit/{id}', [ProductController::class,'edit'])->name('edit');
    Route::put('/product/edit/{id}', [ProductController::class,'update'])->name('update');
    Route::delete('/product/delete/{id}', [ProductController::class,'delete'])->name('delete');
});
