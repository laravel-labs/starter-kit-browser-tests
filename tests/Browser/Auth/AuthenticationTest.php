<?php

use App\Models\User;

test('login screen can be rendered', function () {
    visit(route('login'))
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors()
        ->assertSee('Log in to your account')
        ->assertSee('Enter your email and password below to log in');
});

test('users_can_authenticate_using_the_login_screen', function () {
    $user = User::factory()->create();

    visit(route('login'))
        ->fill('email', $user->email)
        ->fill('password', 'password')
        ->press('Log in')
        ->assertUrlIs(route('dashboard'));

    $this->assertAuthenticated();
});
