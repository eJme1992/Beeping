<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExecutedController;

Route::post('/executed/create', [ExecutedController::class, 'create']);

Route::get('/', function () {
    return view('welcome');
});
