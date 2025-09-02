<?php

test('guests are redirected to the login page', function () {
    visit('/dashboard')
        ->assertPathEndsWith('/login')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors()
        ->assertSee('Log in to your account')
        ->assertSee('Enter your email and password below to log in');
});
