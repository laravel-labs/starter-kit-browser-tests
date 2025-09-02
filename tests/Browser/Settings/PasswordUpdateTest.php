<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\actingAs;

test('password update page is displayed', function () {
    actingAs(User::factory()->create());

    visit(route('password.edit'))
        ->assertSee('Update password')
        ->assertSee('Ensure your account is using a long, random password to stay secure')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();
});

test('password can be updated', function () {
    actingAs($user = User::factory()->create());

    visit(route('password.edit'))
        ->fill('current_password', 'password')
        ->fill('password', 'new-password')
        ->fill('password_confirmation', 'new-password')
        ->press('Save password')
        ->assertSee('Saved.')
        ->assertUrlIs(route('password.edit'))
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();

    expect(Hash::check('new-password', $user->refresh()->password))->toBeTrue();
});

test('correct password must be provided to update password', function () {
    actingAs($user = User::factory()->create());

    visit(route('password.edit'))
        ->fill('current_password', 'wrong-password')
        ->fill('password', 'new-password')
        ->fill('password_confirmation', 'new-password')
        ->press('Save password')
        ->assertSee('The password is incorrect.')
        ->assertUrlIs(route('password.edit'))
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();

    expect(Hash::check('wrong-password', $user->refresh()->password))->toBeFalse();
});
