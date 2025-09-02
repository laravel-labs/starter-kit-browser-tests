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
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors()
        ->click('Register')
        ->assertPathEndsWith('/register')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors()
        ->assertSee('Create an account')
        ->assertSee('Enter your details below to create your account');
});
