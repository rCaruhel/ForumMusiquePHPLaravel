<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes publiques avec les noms corrects pour la navigation
Route::get('/users', [UserController::class, 'all'])->name('users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::patch('/users/addToGroup/{user}', [UserController::class, 'addtogroup'])->name('users.addtogroup');

Route::get('/blogs', [PublicationController::class, 'index'])->name('publications.blogs');
Route::get('/blogs/newDemande',[PublicationController::class,'showNewDemande'])->name('publications.newDemande');
Route::get('/blogs/newPost',[PublicationController::class,'showNewPost'])->name('publications.newPost');
Route::get('/blogs/{blog}/edit',[PublicationController::class,'edit'])->name('publications.edit');
Route::get('/blogs/{blog}', [PublicationController::class, 'show'])->name('publications.show');
Route::post('/user/{user}',[PublicationController::class,'store'])->name('publications.store');
Route::patch('/blogs/{blog}',[PublicationController::class,'update'])->name('publications.update');
Route::post('/blogs/{blog}', [PublicationController::class, 'addComment'])->name('comment.store');


Route::get('/group/create',[GroupController::class,'create'])->name('group.create');
Route::post('/group/create',[GroupController::class,'store'])->name('group.store');
Route::patch('/group/leave',[GroupController::class,'leave'])->name('group.leave');


require __DIR__.'/auth.php';
