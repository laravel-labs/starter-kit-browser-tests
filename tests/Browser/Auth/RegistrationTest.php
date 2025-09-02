<?php

use App\Models\User;

test('registration screen can be rendered', function () {
    visit(route('register'))
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors()
        ->assertSee('Create an account')
        ->assertSee('Enter your details below to create your account');
});

test('new user can be registered', function () {
    visit(route('register'))
        ->fill('name', 'Taylor Otwell')
        ->fill('email', 'taylor@laravel.com')
        ->fill('password', 'password')
        ->fill('password_confirmation', 'password')
        ->press('Create account')
        ->assertPathEndsWith('/dashboard')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();

    $this->assertAuthenticated();
});

test('new user cannot be registered when email has already been taken', function () {
    User::factory()->create([
        'name' => 'Taylor',
        'email' => 'taylor@laravel.com',
    ]);

    visit(route('register'))
        ->fill('name', 'Taylor Otwell')
        ->fill('email', 'taylor@laravel.com')
        ->fill('password', 'password')
        ->fill('password_confirmation', 'password')
        ->press('Create account')
        ->assertSee('The email has already been taken.')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();

    $this->assertGuest();
});

test('new user cannot be registered when password does not match', function () {
    visit(route('register'))
        ->fill('name', 'Taylor Otwell')
        ->fill('email', 'taylor@laravel.com')
        ->fill('password', 'password')
        ->fill('password_confirmation', 'secret')
        ->press('Create account')
        ->assertSee('The password field confirmation does not match.')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();

    $this->assertGuest();
});
