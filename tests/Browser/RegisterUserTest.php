<?php

test('it can show the register page', function () {
    visit('/register')
        ->assertSee('Create an account')
        ->assertSee('Enter your details below to create your account');
});
