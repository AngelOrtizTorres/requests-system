<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RequestController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/language/{lang}', LanguageController::class)->name('change.language');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/requests/create', [RequestController::class, 'createPublic'])->name('requests.create.public')->can('requests.create.public');
    Route::post('/requests', [RequestController::class, 'store'])->name('requests.store.public')->can('requests.create.public');
    Route::get('/requests', [RequestController::class, 'index_public'])->name('requests.index.public')->can('requests.index.public');
    Route::get('/requests/{request}', [RequestController::class, 'showPublic'])->name('requests.show.public')->can('requests.show.public');
    Route::get('/requests/{request}/edit', [RequestController::class, 'editPublic'])->name('requests.edit.public')->can('requests.edit.public');
    Route::put('/requests/{request}', [RequestController::class, 'update'])->name('requests.update')->can('requests.update');
    Route::delete('/requests/{request}', [RequestController::class, 'destroy'])->name('requests.destroy')->can('requests.destroy');
});

require __DIR__.'/settings.php';
