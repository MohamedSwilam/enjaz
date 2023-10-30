<?php

use App\Modules\product\App\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::resource('products', ProductsController::class)
    ->middleware('auth:api')
    ->except(['create', 'edit']);
