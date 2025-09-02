<?php

test('that true is true', function () {
    expect(isset($_SERVER['APP_BASE_PATH']))->toBeTrue();
    expect(isset($_ENV['APP_BASE_PATH']))->toBeTrue();
    expect(true)->toBeTrue();
});
