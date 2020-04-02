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

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *   The application
     *
     * @return void
     */
    // protected function getEnvironmentSetUp($app)
    // {
    //     $app['config']->set('database.default', 'testbench');
    //     $app['config']->set('database.connections.testbench', [
    //         'driver'   => 'sqlite',
    //         'database' => ':memory:',
    //         'prefix'   => '',
    //     ]);
    //     $app['config']->set('tmdb', [
    //         'token' => null,
    //         'api' => 'internal',
    //     ]);
    // }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}
