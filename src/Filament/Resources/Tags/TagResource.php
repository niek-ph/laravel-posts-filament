<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Tags;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use NiekPH\LaravelPostsFilament\Filament\Resources\Tags\Pages\CreateTag;
use NiekPH\LaravelPostsFilament\Filament\Resources\Tags\Pages\EditTag;
use NiekPH\LaravelPostsFilament\Filament\Resources\Tags\Pages\ListTags;
use NiekPH\LaravelPostsFilament\Filament\Resources\Tags\Pages\ViewTag;
use NiekPH\LaravelPostsFilament\Filament\Resources\Tags\Schemas\TagForm;
use NiekPH\LaravelPostsFilament\Filament\Resources\Tags\Schemas\TagInfolist;
use NiekPH\LaravelPostsFilament\Filament\Resources\Tags\Tables\TagsTable;

class TagResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return config('posts.models.tag');
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return __('posts-filament::resources.tags.navigation_group');
    }

    public static function getLabel(): ?string
    {
        return __('posts-filament::resources.tags.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('posts-filament::resources.tags.plural_label');
    }

    public static function form(Schema $schema): Schema
    {
        return TagForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TagInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TagsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTags::route('/'),
            'create' => CreateTag::route('/create'),
            'view' => ViewTag::route('/{record}'),
            'edit' => EditTag::route('/{record}/edit'),
        ];
    }
}
