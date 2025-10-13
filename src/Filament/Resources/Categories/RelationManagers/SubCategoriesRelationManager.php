<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Categories\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\CategoryResource;

class SubCategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'child_categories';

    protected static ?string $relatedResource = CategoryResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->headerActions([
            ]);
    }
}
