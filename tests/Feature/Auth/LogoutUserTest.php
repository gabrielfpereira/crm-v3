<?php

use Livewire\Livewire;

test('user can log out', function () {
    $user = \App\Models\User::factory()->create();

    $this->actingAs($user);
    Livewire::test('auth.logout')
        ->call('logout')
        ->assertRedirect(route('home'));

    $this->assertGuest();

});
