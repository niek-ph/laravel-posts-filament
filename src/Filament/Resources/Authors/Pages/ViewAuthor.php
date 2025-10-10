<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Authors\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use NiekPH\LaravelPostsFilament\Filament\Resources\Authors\AuthorResource;

class ViewAuthor extends ViewRecord
{
    protected static string $resource = AuthorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
