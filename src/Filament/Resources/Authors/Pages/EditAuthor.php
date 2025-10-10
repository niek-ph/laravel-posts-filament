<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Authors\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use NiekPH\LaravelPostsFilament\Filament\Resources\Authors\AuthorResource;

class EditAuthor extends EditRecord
{
    protected static string $resource = AuthorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
