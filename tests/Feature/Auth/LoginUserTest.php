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
