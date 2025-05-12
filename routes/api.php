<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
    // what is
})->middleware('auth:sanctum');


//maybe need 'verified' email?
Route::middleware(['auth', 'verified'])->group(function () {
});

