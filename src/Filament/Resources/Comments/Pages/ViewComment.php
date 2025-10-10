<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Comments\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use NiekPH\LaravelPostsFilament\Filament\Resources\Comments\CommentResource;

class ViewComment extends ViewRecord
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
