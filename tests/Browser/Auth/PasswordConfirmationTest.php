<?php

use App\Models\User;

use function Pest\Laravel\actingAs;

test('confirm password screen can be rendered', function () {
    actingAs(User::factory()->create());

    visit(route('password.confirm'))
        ->assertSee('Confirm your password')
        ->assertSee('This is a secure area of the application. Please confirm your password before continuing.')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();
});

test('password can be confirmed', function () {
    actingAs(User::factory()->create());

    visit(route('password.confirm'))
        ->fill('password', 'password')
        ->press('Confirm Password')
        ->assertUrlIs(route('dashboard'))
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();
});

test('password is not confirmed with invalid password', function () {
    actingAs(User::factory()->create());

    visit(route('password.confirm'))
        ->fill('password', 'wrong-password')
        ->press('Confirm Password')
        ->assertUrlIs(route('password.confirm'))
        ->assertSee('The provided password is incorrect.')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();
});
