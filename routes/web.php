<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExecutedController;

//Route::post('/executed/create', [ExecutedController::class, 'create'])->name('executed.create');

Route::get('/', function () {
    return view('welcome');
});
