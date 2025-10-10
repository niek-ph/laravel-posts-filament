<?php

namespace NiekPH\LaravelPostsFilament;

use Filament\Contracts\Plugin;
use Filament\Panel;

class LaravelPostsFilamentPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'laravel-posts';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources(config('laravel-posts-filament.resources'))
            ->pages([])
            ->widgets([

            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
