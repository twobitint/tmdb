<?php

namespace Twobitint\TMDB\Tests\Unit\API;

use Illuminate\Support\Facades\Http;
use Twobitint\TMDB\Facades\TMDB;

class DiscoverMoviesTest extends APIBase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->fakeHttp(['*/discover/movie*' => [
            'results' => ['id' => 1]
        ]]);
    }

    public function test(): void
    {
        $data = TMDB::discoverMovies();
        $this->assertCount(1, $data);
    }
}
