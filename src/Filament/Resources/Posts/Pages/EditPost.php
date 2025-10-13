<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use NiekPH\LaravelPostsFilament\Filament\Resources\Posts\PostResource;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    //    protected Width | string | null $maxContentWidth = Width::Full;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
