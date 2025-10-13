<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Categories;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Pages\CreateCategory;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Pages\EditCategory;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Pages\ListCategories;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Pages\ViewCategory;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\RelationManagers\PostsRelationManager;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\RelationManagers\SubCategoriesRelationManager;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Schemas\CategoryForm;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Schemas\CategoryInfolist;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Tables\CategoriesTable;

class CategoryResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolderOpen;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return config('posts.models.category');
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return __('posts-filament::resources.categories.navigation_group');
    }

    public static function getLabel(): ?string
    {
        return __('posts-filament::resources.categories.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('posts-filament::resources.categories.plural_label');
    }

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            SubCategoriesRelationManager::class,
            PostsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'view' => ViewCategory::route('/{record}'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
