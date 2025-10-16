<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use NiekPH\LaravelPostsFilament\Filament\Resources\Authors\AuthorResource;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\CategoryResource;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->disk(config('posts-filament.uploads.disk', 'public'))
                    ->toggleable(),
                TextColumn::make('title')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('url')
                    ->color('primary')
                    ->url(fn ($state) => $state)
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('full_path')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('author.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->url(fn (?Model $record) => AuthorResource::getUrl('view', ['record' => $record->getAttribute('author_id')]))
                    ->color('primary'),
                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->url(fn (?Model $record) => CategoryResource::getUrl('view', ['record' => $record->getAttribute('category_id')]))
                    ->color('primary'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
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
