<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostCatatan;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('notes/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('notes/list', function () {
//     return view('catatan');                         
// })->middleware(['auth', 'verified'])->name('notes');

Route::get('notes/list', [PostCatatan::class, 'index'])->middleware(['auth', 'verified'])->name('notes');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//CRUD
Route::get('notes/list', [PostCatatan::class, 'index'])->middleware(['auth', 'verified'])->name('notes');
Route::post('notes/list', [PostCatatan::class, 'store'])->middleware(['auth', 'verified']);
// Route::post('notes/list/{id}', [PostCatatan::class, 'update'])->middleware(['auth', 'verified']);
Route::get('notes/list/{id}/edit', [PostCatatan::class, 'edit'])->middleware(['auth', 'verified']);
Route::delete('notes/list/{id}', [PostCatatan::class, 'destroy'])->middleware(['auth', 'verified']);


// Controller PostCatatan
Route::resource('notes', PostCatatan::class);

require __DIR__.'/auth.php';
