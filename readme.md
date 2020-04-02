<p align="center">
    <a href="https://github.com/twobitint/tmdb/actions"><img src="https://github.com/twobitint/tmdb/workflows/tests/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/twobitint/tmdb"><img src="https://poser.pugx.org/twobitint/tmdb/d/total.svg" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/twobitint/tmdb"><img src="https://poser.pugx.org/twobitint/tmdb/v/stable.svg" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/twobitint/tmdb"><img src="https://poser.pugx.org/twobitint/tmdb/license.svg" alt="License"></a>
</p>

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
