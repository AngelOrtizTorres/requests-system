<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\RequestController;

Route::get('/', function() {
    $stats = [
        'users' => \App\Models\User::count(),
        'tags' => \App\Models\Tag::count(),
        'requests_total' => \App\Models\Request::count(),
        'requests_pending' => \App\Models\Request::where('status_id', 'pending')->count(),
        'requests_approved' => \App\Models\Request::where('status_id', 'approved')->count(),
        'requests_rejected' => \App\Models\Request::where('status_id', 'rejected')->count(),
    ];
    
    return view('dashboard', compact('stats'));
})->name('index')->can('dashboard.index');

Route::resource('users', UserController::class)->names('users')->middleware(['can:dashboard.users.index', 'role:admin']);

Route::resource('tags', TagController::class)->names('tags')->middleware(['can:dashboard.tags.index', 'role:admin']);

Route::resource('requests', RequestController::class)->names('requests')->middleware('can:dashboard.requests.index');