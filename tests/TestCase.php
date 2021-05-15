<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    /**
     * Reset the migrations
     */
    protected function tearDown(): void
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }
}
