<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

test('reset password link screen can be rendered', function () {
    visit(route('password.request'))
        ->assertSee('Forgot password')
        ->assertSee('Enter your email to receive a password reset link')
        ->assertNoConsoleLogs()
        ->assertNoJavaScriptErrors();
});

test('test_reset_password_link_can_be_requested', function () {
    Notification::fake();

    $user = User::factory()->create();

    visit(route('password.request'))
        ->fill('email', $user->email)
        ->press('Email password reset link')
        ->assertSee('A reset link will be sent if the account exists.');

    Notification::assertSentTo($user, ResetPassword::class);
});

    // public function test_reset_password_screen_can_be_rendered()
    // {
    //     Notification::fake();

    //     $user = User::factory()->create();

    //     $this->post(route('password.email'), ['email' => $user->email]);

    //     Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
    //         $response = $this->get(route('password.request', $notification->token));

    //         $response->assertStatus(200);

    //         return true;
    //     });
    // }

    // public function test_password_can_be_reset_with_valid_token()
    // {
    //     Notification::fake();

    //     $user = User::factory()->create();

    //     $this->post(route('password.email'), ['email' => $user->email]);

    //     Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
    //         $response = $this->post(route('password.store'), [
    //             'token' => $notification->token,
    //             'email' => $user->email,
    //             'password' => 'password',
    //             'password_confirmation' => 'password',
    //         ]);

    //         $response
    //             ->assertSessionHasNoErrors()
    //             ->assertRedirect(route('login'));

    //         return true;
    //     });
    // }

    // public function test_password_cannot_be_reset_with_invalid_token(): void
    // {
    //     $user = User::factory()->create();

    //     $response = $this->post(route('password.store'), [
    //         'token' => 'invalid-token',
    //         'email' => $user->email,
    //         'password' => 'newpassword123',
    //         'password_confirmation' => 'newpassword123',
    //     ]);

    //     $response->assertSessionHasErrors('email');
    // }
