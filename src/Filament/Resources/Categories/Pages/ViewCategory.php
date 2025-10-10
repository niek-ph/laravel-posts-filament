<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\CategoryResource;

class ViewCategory extends ViewRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
