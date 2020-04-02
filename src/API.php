<?php

namespace Twobitint\TMDB;

use Illuminate\Support\Collection;
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
     * Collection of query options for this API request.
     */
    protected $options = [];

    /**
     * Constructed API request URI.
     */
    protected $uri;

    /**
     * Build the TMDB API wrapper object.
     *
     * @param array $config
     *   The tmdb config array
     */
    public function __construct(array $config = [])
    {
        $this->token = $config['token'] ?? null;
        $this->api = $config['api'] ?? null;
        $this->driver = $config['driver'] ?? 'http';
    }

    /**
     * Merge options into the request.
     *
     * @param array $options
     *   The options to merge
     *
     * @return self
     *   Chainable
     */
    public function options(array $options): self
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    /**
     * Set the URI for this request.
     *
     * @param string $uri
     *   The URI to set
     *
     * @return self
     *   Chainable
     */
    public function uri(string $uri): self
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * Get a movie listing from the discover endpoint.
     *
     * @param array $options
     *   (Optional) Options to add to the request
     *
     * @return mixed
     *   The movie listing or null/error
     */
    public function discoverMovies()
    {
        return $this->get('discover/movie');
    }

    /**
     * Get a TV listing from the discover endpoint.
     *
     * @param array $options
     *   (Optional) Options to add to the request
     *
     * @return mixed
     *   The tv listing or null/error
     */
    public function discoverTV()
    {
        return $this->get('discover/tv');
    }

    /**
     * See what's trending.
     *
     * @param string mediaType
     *   (Optional) Must be one of: all, movie, tv, person
     * @param string timeWindow
     *   (Optional) Must be one of: day, week
     */
    public function trending($mediaType = 'all', $timeWindow = 'day')
    {
        return $this->get('trending/'.$mediaType.'/'.$timeWindow);
    }

    /**
     * Begin a movie request chain.
     *
     * @param int $id
     *   The TMDB movie id
     *
     * @return self
     *   Chainable
     */
    public function movie(int $id): self
    {
        return $this->uri('movie/'.$id);
    }

    /**
     * Query the api to get a json response.
     *
     * @param string $uri
     *   (Optional) The request uri
     * @param array $options
     *   (Optional) Options to add to the request
     *
     * @return mixed
     *   The data array, or a collection of results, or an exception, on error.
     */
    public function get(string $uri = null, array $options = [])
    {
        if ($uri) {
            $this->uri($uri);
        }

        $this->options = array_merge($this->options, $options);

        $response = Http::withToken($this->token)
            ->get($this->api . $this->uri, $this->options);

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

    /**
     * Bundle the json response into a collection.
     *
     * @param array $data
     *   The json response
     *
     * @return \Illuminate\Support\Collection
     *   A collection of the response data
     */
    protected function bundle(array $data): Collection
    {
        if (!isset($data['results'])) {
            return collect($data);
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
