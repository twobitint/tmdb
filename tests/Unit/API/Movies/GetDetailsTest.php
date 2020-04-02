<?php

namespace Twobitint\TMDB\Tests\Unit\API\Movies;

use Illuminate\Support\Facades\Http;
use Twobitint\TMDB\Tests\Unit\API\APIBase;

class GetDetailsTest extends APIBase
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
            '*/movie/1' => Http::response([
                'id' => 1,
            ]),
        ]);
    }

    // public function test()
    // {
    //     $data = $this->api->discoverMovies();
    //     $this->assertCount(1, $data);
    // }
}
