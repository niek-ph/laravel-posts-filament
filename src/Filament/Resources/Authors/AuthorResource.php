<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Authors;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use NiekPH\LaravelPostsFilament\Filament\Resources\Authors\Pages\CreateAuthor;
use NiekPH\LaravelPostsFilament\Filament\Resources\Authors\Pages\EditAuthor;
use NiekPH\LaravelPostsFilament\Filament\Resources\Authors\Pages\ListAuthors;
use NiekPH\LaravelPostsFilament\Filament\Resources\Authors\Pages\ViewAuthor;
use NiekPH\LaravelPostsFilament\Filament\Resources\Authors\Schemas\AuthorForm;
use NiekPH\LaravelPostsFilament\Filament\Resources\Authors\Schemas\AuthorInfolist;
use NiekPH\LaravelPostsFilament\Filament\Resources\Authors\Tables\AuthorsTable;
use UnitEnum;

class AuthorResource extends Resource
{

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return config('posts.models.author');
    }

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return __('posts-filament::resources.authors.navigation_group');
    }

    public static function getLabel(): ?string
    {
        return __('posts-filament::resources.authors.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('posts-filament::resources.authors.plural_label');
    }

    public static function form(Schema $schema): Schema
    {
        return AuthorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AuthorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AuthorsTable::configure($table);
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
            'index' => ListAuthors::route('/'),
            'create' => CreateAuthor::route('/create'),
            'view' => ViewAuthor::route('/{record}'),
            'edit' => EditAuthor::route('/{record}/edit'),
        ];
    }
}
