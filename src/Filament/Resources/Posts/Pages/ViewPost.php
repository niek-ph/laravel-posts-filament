<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use NiekPH\LaravelPostsFilament\Filament\Resources\Posts\PostResource;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
