<?php

test('user can log out', function () {
    $user = \App\Models\User::factory()->create();

    $this->actingAs($user)
        ->get('/logout')
        ->assertRedirect(route('home'));

    $this->assertGuest();
});
