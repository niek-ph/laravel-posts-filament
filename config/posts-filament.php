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
    ],
    /**
     * Here you can customize how files are uploaded via the Markdown Editor.s
     */
    'uploads' => [
        /**
         * The disk the files should be uploaded to.
         */
        'disk' => 'public',
        /**
         * The directory files should be uploaded to.
         */
        'directory' => 'media',
        /**
         * The allowed mime types for uploading files.
         */
        'mimes' => ['image/png', 'image/jpeg', 'image/gif', 'image/webp'],
        /**
         * The maximum file size for uploads. Default is 12,288 KB (12MB) which is the filament default.
         */
        'file_size' => 12288,
    ],
];
