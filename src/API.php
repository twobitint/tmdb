<?php

namespace Twobitint\TMDB;

use Illuminate\Support\Facades\Http;

class API
{
    /**
     * The TMDB API configuration variables.
     *
     * These are both determined when the class is instantiated based on
     * the values available in config/tmdb.
     */
    protected $token;
    protected $api;

    /**
     * Build the TMDB API wrapper object.
     *
     * @param array $config
     *   The tmdb config array
     */
    public function __construct(array $config = [])
    {
        //dd($config);
        $this->token = $config['token'] ?? null;
        $this->api = $config['api'] ?? null;
    }

    /**
     * Get a movie listing from the discover endpoint.
     *
     * @param array $options
     *   (Optional) Options to add to the request
     *
     * @return array
     *   The movie listing
     */
    public function discoverMovies(array $options = [])
    {
        return $this->get('discover/movie', $options);
    }

    /**
     * Get a TV listing from the discover endpoint.
     *
     * @param array $options
     *   (Optional) Options to add to the request
     *
     * @return array
     *   The tv listing
     */
    public function discoverTV(array $options = [])
    {
        return $this->get('discover/tv', $options);
    }

    public function movie(int $id)
    {
        //
    }

    /**
     * Query the api to get a json response.
     *
     * @param string $uri
     *   The request uri
     * @param array $options
     *   (Optional) Options to add to the request
     *
     * @return mixed
     *   The data array, or a collection of results, or an exception, on error.
     */
    protected function get(string $uri, array $options = [])
    {
        $response = Http::withToken($this->token)
            ->get($this->api . $uri, $options);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['results'])) {
                return $this->bundle($data);
            } else {
                return $data;
            }
        } else {
            $response->throw();
        }
    }

    protected function bundle(array $data)
    {
        if (!isset($data['results'])) {
            return collect();
        }

        $collection = collect($data['results']);

        if ($page = $data['page'] ?? false) {
            $collection->setPage($page);
        }
        if ($totalPages = $data['total_pages'] ?? false) {
            $collection->setTotalPages($totalPages);
        }
        if ($totalResults = $data['total_results'] ?? false) {
            $collection->setTotalPages($totalResults);
        }

        return $collection;
    }
}
