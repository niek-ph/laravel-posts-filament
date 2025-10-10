<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Comments\Pages;

use Filament\Resources\Pages\CreateRecord;
use NiekPH\LaravelPostsFilament\Filament\Resources\Comments\CommentResource;

class CreateComment extends CreateRecord
{
    protected static string $resource = CommentResource::class;
}
