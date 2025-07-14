<?php

use App\Livewire\Auth\RegisterUser;
use Illuminate\Support\Facades\{Auth, Route};

Route::get('/register', RegisterUser::class)->name('register');
Route::get('/logout', function () {
    Auth::logout();

    return redirect()->route('home');
})->name('logout');
