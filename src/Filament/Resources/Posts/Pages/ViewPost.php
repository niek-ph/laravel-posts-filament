<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Pages;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use NiekPH\LaravelPostsFilament\Filament\Resources\Posts\PostResource;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        $isPublished = ! is_null($this->record->published_at);

        return [
            EditAction::make(),

            Action::make('save_draft')
                ->label($isPublished ? 'Make draft' : 'Publish')
                ->color('primary')
                ->action(function () use ($isPublished) {

                    if ($isPublished) {
                        $this->record->update(['published_at' => null]);
                    } else {
                        $this->record->update(['published_at' => now()]);
                    }

                    Notification::make()->success()->body('Saved!')->send();
                    redirect(static::getUrl(['record' => $this->record->id]));
                }),
        ];
    }
}
