<?php

namespace NiekPH\LaravelPostsFilament\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NiekPH\LaravelPostsFilament\LaravelPostsFilament
 */
class LaravelPostsFilament extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \NiekPH\LaravelPostsFilament\LaravelPostsFilament::class;
    }
}
