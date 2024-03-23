<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExecutedController;

Route::post('/executed/create', [ExecutedController::class, 'create'])->name('api.executed.create');


