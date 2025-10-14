<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Categories\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use NiekPH\LaravelPostsFilament\Filament\Resources\Posts\PostResource;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    protected static ?string $relatedResource = PostResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->headerActions([
            ]);
    }
}
