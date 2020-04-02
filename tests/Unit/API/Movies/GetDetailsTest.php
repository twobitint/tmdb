<?php

namespace Twobitint\TMDB\Tests\Unit\API\Movies;

use Illuminate\Http\Client\RequestException;
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

    public function testMovieExists()
    {
        $movieId = 1;
        $data = $this->api->movie(1)->get();
        $this->assertEquals($movieId, $data['id']);
    }

    public function testMovieDoesNotExist()
    {
        $movieId = 2;
        $this->expectException(RequestException::class);
        $data = $this->api->movie($movieId)->get();
    }
}
