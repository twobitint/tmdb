<?php

namespace Twobitint\TMDB\Tests\Unit\API;

use Illuminate\Support\Facades\Http;
use Twobitint\TMDB\API;
use Twobitint\TMDB\Tests\UnitTest;

class APIBase extends UnitTest
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Fake the Http request/response system used by the API wrapper.
     *
     * @param array $parameters
     *   The parameters: [$uri => $response, ...]
     *
     * @return void
     */
    protected function fakeHttp(array $parameters): void
    {
        // Convert our parameterized options into an Http response stub list.
        $stubs = collect($parameters)->mapWithKeys(function ($response, $uri) {
            return [
                $uri => Http::response($response)
            ];
        })->toArray();

        // Fallback wildcard stub will be a 404 for all requests unmatched.
        $fallback = ['*' => Http::response('404', 404)];

        // Combine both.
        $stubs = array_merge($stubs, $fallback);

        Http::fake($stubs);
    }
}
