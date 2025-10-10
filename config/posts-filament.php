<?php

return [
    /**
     * You can optionally override the default resources provided by this package
     */
    'resources' => [
        'AuthorResource' => \NiekPH\LaravelPostsFilament\Filament\Resources\Authors\AuthorResource::class,
        'CategoryResource' => \NiekPH\LaravelPostsFilament\Filament\Resources\Categories\CategoryResource::class,
        'PostResource' => \NiekPH\LaravelPostsFilament\Filament\Resources\Posts\PostResource::class,
        'TagResource' => \NiekPH\LaravelPostsFilament\Filament\Resources\Tags\TagResource::class,
        'CommentResource' => \NiekPH\LaravelPostsFilament\Filament\Resources\Comments\CommentResource::class,
    ]
];
