<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Pages;

use Filament\Resources\Pages\CreateRecord;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\CategoryResource;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

}
