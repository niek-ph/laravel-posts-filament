<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Comments\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use NiekPH\LaravelPostsFilament\Filament\Resources\Comments\CommentResource;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
