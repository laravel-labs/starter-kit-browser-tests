<?php

use App\Models\User;

test('it can show the register page', function () {
    visit('/register')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors()
        ->assertSee('Create an account')
        ->assertSee('Enter your details below to create your account');
});

test('it can register a new user', function () {
    visit('/register')
        ->fill('name', 'Taylor Otwell')
        ->fill('email', 'taylor@laravel.com')
        ->fill('password', 'password')
        ->fill('password_confirmation', 'password')
        ->press('Create account')
        ->assertPathEndsWith('/dashboard');

    $this->assertAuthenticated();
});

test('it cannot register a new user when email has already been taken', function () {
    User::factory()->create([
        'name' => 'Taylor',
        'email' => 'taylor@laravel.com',
    ]);

    visit('/register')
        ->fill('name', 'Taylor Otwell')
        ->fill('email', 'taylor@laravel.com')
        ->fill('password', 'password')
        ->fill('password_confirmation', 'password')
        ->press('Create account')
        ->assertSee('The email has already been taken.');

    $this->assertGuest();
});

test('it cannot register a new user when password does not match', function () {
    visit('/register')
        ->fill('name', 'Taylor Otwell')
        ->fill('email', 'taylor@laravel.com')
        ->fill('password', 'password')
        ->fill('password_confirmation', 'secret')
        ->press('Create account')
        ->assertSee('The password field confirmation does not match.');

    $this->assertGuest();
});
