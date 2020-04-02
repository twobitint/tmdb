<?php

namespace Twobitint\TMDB\Tests\Unit\API;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Twobitint\TMDB\Facades\TMDB;

class TrendingTest extends APIBase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $movies = [
            [
                'id' => 1,
                'media_type' => 'movie',
            ],
        ];
        $tv = [
            [
                'id' => 2,
                'media_type' => 'tv',
            ],
        ];
        $people = [
            [
                'id' => 3,
                'media_type' => 'person',
            ],
        ];
        $all = array_merge($movies, $tv, $people);

        $this->fakeHttp([
            '*/trending/movie/day' => [
                'results' => $movies,
            ],
            '*/trending/movie/week' => [
                'results' => $movies,
            ],
            '*/trending/tv/day' => [
                'results' => $tv,
            ],
            '*/trending/tv/week' => [
                'results' => $tv,
            ],
            '*/trending/person/day' => [
                'results' => $people,
            ],
            '*/trending/person/week' => [
                'results' => $people,
            ],
            '*/trending/all/day' => [
                'results' => $all,
            ],
            '*/trending/all/week' => [
                'results' => $all,
            ],
        ]);
    }

    public function testGoodInput(): void
    {
        // All possible inputs.
        $types = ['movie', 'tv', 'person'];
        $times = ['day', 'week'];

        // Test single types.
        foreach ($types as $type) {
            $this->assertCount(1, TMDB::trending($type));
            foreach ($times as $time) {
                $this->assertCount(1, TMDB::trending($type, $time));
            }
        }

        // Test combined types.
        $this->assertCount(3, TMDB::trending('all'));
        foreach ($times as $time) {
            $this->assertCount(3, TMDB::trending('all', $time));
        }

        // Test defaults.
        $this->assertCount(3, TMDB::trending());
    }

    public function testBadInput(): void
    {
        // Test bad type.
        $this->expectException(RequestException::class);
        TMDB::trending('bananas');

        // Test bad time.
        $this->expectException(RequestException::class);
        TMDB::trending('all', 'year');
    }
}
