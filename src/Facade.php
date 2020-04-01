<?php

namespace Twobitint\TMDB;

use Illuminate\Support\Facades\Facade;

class TMDB extends Facade
{
    protected static function getFacadeAccessor()
    {
        return API::class;
    }
}
