<?php

namespace Twobitint\TMDB\Tests\Unit\API;

use Twobitint\TMDB\API;
use Twobitint\TMDB\Tests\UnitTest;

class APIBase extends UnitTest
{
    /**
     * Our api singleton for testing.
     */
    protected $api;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp() : void
    {
        parent::setUp();

        $this->api = $this->app->make(API::class);
    }
}
