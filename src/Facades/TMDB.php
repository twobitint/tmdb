<?php

namespace Twobitint\TMDB\Facades;

use Illuminate\Support\Facades\Facade;
use Twobitint\TMDB\API;

class TMDB extends Facade
{
    protected static function getFacadeAccessor()
    {
        return API::class;
    }
}
