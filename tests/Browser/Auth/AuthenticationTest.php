<?php

use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

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

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    visit(route('login'))
        ->fill('email', $user->email)
        ->fill('password', 'wrong-password')
        ->press('Log in')
        ->assertUrlIs(route('login'))
        ->assertSee('These credentials do not match our records.');

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    visit(route('dashboard'))
        ->click($user->name)
        ->click('Log out')
        ->assertUrlIs(route('home'));

    $this->assertGuest();
});

test('users are rate limited', function () {
    $user = User::factory()->create();

    RateLimiter::increment(implode('|', [$user->email, '127.0.0.1']), amount: 10);

    visit(route('login'))
        ->fill('email', $user->email)
        ->fill('password', 'wrong-password')
        ->press('Log in')
        ->assertUrlIs(route('login'))
        ->assertSee('Too many login attempts. Please try again in');
});

