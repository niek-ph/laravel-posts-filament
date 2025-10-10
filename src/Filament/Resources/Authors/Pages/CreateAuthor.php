<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Authors\Pages;

use Filament\Resources\Pages\CreateRecord;
use NiekPH\LaravelPostsFilament\Filament\Resources\Authors\AuthorResource;

class CreateAuthor extends CreateRecord
{
    protected static string $resource = AuthorResource::class;
}
