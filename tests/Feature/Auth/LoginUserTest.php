<?php

use App\Models\User;
use Livewire\Livewire;

test('user can login with valid credentials', function () {
    $user = User::factory()->create([
        'email'    => 'jhon@doe.com',
        'password' => 'Password@123',
    ]);

    Livewire::test('auth.login')
        ->set('email', 'jhon@doe.com')
        ->set('password', 'Password@123')
        ->call('login')
        ->assertRedirect('/dashboard');
    $this->assertAuthenticatedAs($user);
});

test('ratelimiters are applied on login attempts', function () {
    $user = User::factory()->create([
        'email'    => 'joe@doe.com',
        'password' => 'Password@123',
    ]);

    for ($i = 0; $i < 5; $i++) {
        Livewire::test('auth.login')
        ->set('email', 'joe@dok.com')
        ->set('password', 'Password@125')
        ->call('login')
        ->assertHasErrors(['ops' => 'The provided credentials do not match our records.']);
        $this->assertGuest();
    }

    Livewire::test('auth.login')
        ->set('email', 'joe@dok.com')
        ->set('password', 'Password@125')
        ->call('login')
        ->assertHasErrors(['attempts']);
});
