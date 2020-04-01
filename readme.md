# TMDB API Laravel Wrapper

A laravel package for interracting with the TMDB API.

## Install

```
composer require twobitint/tmdb
```

## Configure

Your `.env` file should include an `TMDB_TOKEN` key with a v4 token generated via the TMDB developer website. Specific config values can be modified in `config/tmdb.php`

## Usage

The API can be accessed via dependency injection:

```
use Twobitint\TMDB\API;

Route::get('/', function (API $api) {
    return $api->discoverMovies();
});
```

The API is also available via a facade:

```
use TMDB;

Route::get('/', function() {
    return TMDB::discoverMovies();
});
```

## Available methods and documentation

coming later
