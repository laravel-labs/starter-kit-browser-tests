<?php

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
