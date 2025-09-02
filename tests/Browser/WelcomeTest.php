<?php

test('it can show the default welcome page', function () {
    visit('/')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors()
        ->assertSee('Let\'s get started')
        ->assertSee('Log In')
        ->assertSee('Register');
});

test('it can browse to the register page', function () {
    visit('/')
        ->click('Register')
        ->assertPathEndsWith('/register')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors()
        ->assertSee('Create an account')
        ->assertSee('Enter your details below to create your account');
});

test('it can browse to the login page', function () {
    visit('/')
        ->click('Log in')
        ->assertPathEndsWith('/login')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors()
        ->assertSee('Log in to your account')
        ->assertSee('Enter your email and password below to log in');
});
