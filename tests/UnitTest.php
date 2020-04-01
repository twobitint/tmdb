<?php

namespace Twobitint\TMDB\Tests;

use Mockery;
use Twobitint\TMDB\API;
use Twobitint\TMDB\Facades\TMDB as Facade;
use Orchestra\Testbench\TestCase;

abstract class UnitTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [API::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'TMDB' => Facade::class,
        ];
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}
