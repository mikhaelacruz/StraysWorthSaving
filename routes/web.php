<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/success', function () {
    return view('success');
});

Route::get('/gallery', function () {
    return view('gallery');
});

Route::get('/donate', function () {
    return view('donate');
});

Route::get('/gallery', function () {
    return view('gallery');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::get('/policies', [UserController::class, 'policies'])->name('policies');

    Route::get('/adopt', [UserController::class, 'adopt'])->name('adopt');

    Route::delete('/adopt/{id}', [AdminController::class, 'destroy'])->name('adopt.destroy')->middleware('checkAdmin');

    Route::get('/adoptionrequest/{strayId}', [UserController::class, 'adoptionrequest'])->name('adoptionrequest');

    Route::post('/adoptionrequest', [UserController::class, 'store'])->name('adoptionrequest.store');

    Route::get('/adoptionrequests', [UserController::class, 'adoptionrequests'])->name('adoptionrequests');


    Route::get('/addstray', [AdminController::class, 'addstray'])->name('addstray')->middleware('checkAdmin');

    Route::post('/addstray', [AdminController::class, 'store'])->name('addstray.store')->middleware('checkAdmin');


    Route::get('/editstray/{strayId}', [AdminController::class, 'editstray'])->name('editstray')->middleware('checkAdmin');

    Route::put('/editstray/{strayId}', [AdminController::class, 'update'])->name('editstray.update')->middleware('checkAdmin');


});

