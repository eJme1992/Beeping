<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExecutedController;

//Route::post('/executed/create', [ExecutedController::class, 'create'])->name('executed.create');

Route::get('/', function () {
    return view('welcome');
});


// ROUTES FOR AUTHENTICATION
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(
    function(){
   
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

});
