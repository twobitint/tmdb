<?php

namespace Twobitint\TMDB\Tests\Unit\API\Movies;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Twobitint\TMDB\Facades\TMDB;
use Twobitint\TMDB\Tests\Unit\API\APIBase;

class GetDetailsTest extends APIBase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->fakeHttp(['*/movie/1' => ['id' => 1]]);
    }

    public function testMovieExists(): void
    {
        $movieId = 1;
        $data = TMDB::movie(1)->get();
        $this->assertEquals($movieId, $data['id']);
    }

    public function testMovieDoesNotExist(): void
    {
        $movieId = 2;
        $this->expectException(RequestException::class);
        $data = TMDB::movie($movieId)->get();
    }
}
