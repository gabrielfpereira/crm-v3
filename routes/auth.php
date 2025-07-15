<?php

use App\Livewire\Auth\RegisterUser;
use Illuminate\Support\Facades\{Auth, Route};

Route::get('/register', RegisterUser::class)->name('register');
Route::get('/logout', function () {
    Auth::logout();

    return redirect()->route('home');
})->name('logout');
Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
Route::get('/recovery-password', \App\Livewire\Auth\RecoveryPassword::class)->name('auth.recovery-password');
Route::get('/password/reset', \App\Livewire\Auth\ResetPassword::class)->name('password.reset');
