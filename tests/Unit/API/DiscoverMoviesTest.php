<?php

namespace Twobitint\TMDB\Tests\Unit\API;

use Illuminate\Support\Facades\Http;

class DiscoverMoviesTest extends APIBase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp() : void
    {
        parent::setUp();

        Http::fake([
            '*/discover/movie*' => Http::response([
                'results' => [
                    [
                        'id' => 1
                    ]
                ]
            ]),
        ]);
    }

    public function test()
    {
        $data = $this->api->discoverMovies();
        $this->assertCount(1, $data);
    }
}
