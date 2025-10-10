<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Tags\Pages;

use Filament\Resources\Pages\CreateRecord;
use NiekPH\LaravelPostsFilament\Filament\Resources\Tags\TagResource;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;
}
