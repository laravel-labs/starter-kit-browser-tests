<?php

use App\Models\User;

test('guests are redirected to the login page', function () {
    visit('/dashboard')
        ->assertPathEndsWith('/login')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors()
        ->assertSee('Log in to your account')
        ->assertSee('Enter your email and password below to log in');
});

test('authenticated users can visit the dashboard', function () {
    $this->actingAs(User::factory()->create());

    visit('/dashboard')
        ->assertPathEndsWith('/dashboard')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();
});
