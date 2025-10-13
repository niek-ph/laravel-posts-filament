<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\CategoryResource;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    public function table(Table $table): Table
    {
        return parent::table($table)->modifyQueryUsing(fn ($query) => $query->whereNull('parent_category_id'));
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
