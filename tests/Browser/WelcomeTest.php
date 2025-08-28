<?php

test('it can show the default welcome page', function () {
    $page = visit('/');

    $page->assertSee('Let\'s get started')
        ->assertSee('Log In')
        ->assertSee('Register');
});
