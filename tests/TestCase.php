<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\RequiresEnvironmentVariable;

#[RequiresEnvironmentVariable('APP_BASE_PATH')]
abstract class TestCase extends BaseTestCase
{
    /** {@inheritdoc} */
    #[\Override]
    public function createApplication()
    {
        if (! isset($_ENV['APP_BASE_PATH']) && isset($_SERVER['APP_BASE_PATH'])) {
            $_ENV['APP_BASE_PATH'] = $_SERVER['APP_BASE_PATH'];
        }

        return parent::createApplication();
    }
}
