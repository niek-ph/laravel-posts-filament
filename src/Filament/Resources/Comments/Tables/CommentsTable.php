<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Comments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use NiekPH\LaravelPostsFilament\Filament\Resources\Posts\PostResource;

class CommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('post.title')
                    ->url(fn (?Model $record) => PostResource::getUrl('view', ['record' => $record->getAttribute('post_id')]))
                    ->color('primary')
                    ->sortable(),
                TextColumn::make('rating'),
                TextColumn::make('comment')
                    ->searchable(),
                TextColumn::make('author_name'),
                TextColumn::make('author_email'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
