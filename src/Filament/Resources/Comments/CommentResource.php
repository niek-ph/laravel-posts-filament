<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Comments;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use NiekPH\LaravelPostsFilament\Filament\Resources\Comments\Pages\CreateComment;
use NiekPH\LaravelPostsFilament\Filament\Resources\Comments\Pages\EditComment;
use NiekPH\LaravelPostsFilament\Filament\Resources\Comments\Pages\ListComments;
use NiekPH\LaravelPostsFilament\Filament\Resources\Comments\Pages\ViewComment;
use NiekPH\LaravelPostsFilament\Filament\Resources\Comments\Schemas\CommentForm;
use NiekPH\LaravelPostsFilament\Filament\Resources\Comments\Schemas\CommentInfolist;
use NiekPH\LaravelPostsFilament\Filament\Resources\Comments\Tables\CommentsTable;

class CommentResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Megaphone;

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?int $navigationSort = 3;

    public static function getModel(): string
    {
        return config('posts.models.comment');
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return __('posts-filament::resources.comments.navigation_group');
    }

    public static function getLabel(): ?string
    {
        return __('posts-filament::resources.comments.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('posts-filament::resources.comments.plural_label');
    }

    public static function form(Schema $schema): Schema
    {
        return CommentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CommentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommentsTable::configure($table);
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
            'index' => ListComments::route('/'),
            'create' => CreateComment::route('/create'),
            'view' => ViewComment::route('/{record}'),
            'edit' => EditComment::route('/{record}/edit'),
        ];
    }
}
