<?php

namespace Twobitint\TMDB\Tests;

use Mockery;
use Twobitint\TMDB\ServiceProvider;
use Twobitint\TMDB\Facades\TMDB;
use Orchestra\Testbench\TestCase;

abstract class UnitTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'TMDB' => TMDB::class,
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
