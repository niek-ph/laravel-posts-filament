<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Posts;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Pages\CreatePost;
use NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Pages\EditPost;
use NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Pages\ListPosts;
use NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Pages\ViewPost;
use NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Schemas\PostForm;
use NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Schemas\PostInfolist;
use NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Tables\PostsTable;
use UnitEnum;

class PostResource extends Resource
{

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentText;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getModel(): string
    {
        return config('posts.models.post');
    }

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return __('posts-filament::resources.posts.navigation_group');
    }

    public static function getLabel(): ?string
    {
        return __('posts-filament::resources.posts.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('posts-filament::resources.posts.plural_label');
    }

    public static function form(Schema $schema): Schema
    {
        return PostForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PostInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
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
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'view' => ViewPost::route('/{record}'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
