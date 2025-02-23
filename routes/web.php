<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::get('/upload', [UserController::class, 'showUploadForm'])->name('upload.form');
Route::post('/import', [UserController::class, 'import'])->name('import');

Route::get('/', function () {
    return view('welcome');
});
