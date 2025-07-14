<?php

use App\Livewire\Auth\RegisterUser;
use Illuminate\Support\Facades\Route;

Route::get('/register', RegisterUser::class)->name('register');
