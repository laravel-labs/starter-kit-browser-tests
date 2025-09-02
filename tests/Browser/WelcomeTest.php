<?php

test('it can show the default welcome page', function () {
    visit('/')
        ->assertSee('Let\'s get started')
        ->assertSee('Log In')
        ->assertSee('Register');
});
