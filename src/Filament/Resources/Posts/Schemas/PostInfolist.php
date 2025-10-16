<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Main Post Information Section
                Section::make('Post Details')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        TextEntry::make('title')
                            ->weight('bold'),
                        TextEntry::make('slug')
                            ->copyable()
                            ->color('gray'),
                        TextEntry::make('url')
                            ->url(fn ($state) => $state)
                            ->color('primary')
                            ->icon('heroicon-o-link')
                            ->columnSpanFull(),
                        TextEntry::make('excerpt')
                            ->placeholder('No excerpt provided')
                            ->columnSpanFull(),
                        KeyValueEntry::make('metadata'),

                    ]),

                // Publishing & Organization Section
                Section::make('Publishing & Organization')
                    ->icon('heroicon-o-calendar')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('published_at')
                                    ->dateTime()
                                    ->placeholder('Not published')
                                    ->icon('heroicon-o-calendar'),
                                TextEntry::make('author.name')
                                    ->label('Author')
                                    ->placeholder('No author assigned')
                                    ->icon('heroicon-o-user'),
                                TextEntry::make('category.name')
                                    ->label('Category')
                                    ->placeholder('Uncategorized')
                                    ->icon('heroicon-o-tag'),
                            ]),
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('sort_order')
                                    ->numeric()
                                    ->placeholder('No sort order set')
                                    ->label('Sort Order'),
                                TextEntry::make('created_at')
                                    ->dateTime()
                                    ->placeholder('-')
                                    ->label('Created')
                                    ->icon('heroicon-o-plus-circle'),
                                TextEntry::make('updated_at')
                                    ->dateTime()
                                    ->placeholder('-')
                                    ->label('Last Updated')
                                    ->icon('heroicon-o-pencil-square'),
                            ]),
                    ]),

                // Media Section
                Section::make('Media')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        ImageEntry::make('featured_image')
                            ->placeholder('No featured image')
                            ->disk(config('posts-filament.uploads.disk', 'public'))
                            ->imageHeight(200)
                            ->imageWidth('100%')
                            ->columnSpanFull(),
                    ]),

                // SEO Section
                Section::make('SEO Settings')
                    ->icon('heroicon-o-magnifying-glass')
                    ->schema([
                        TextEntry::make('seo_title')
                            ->placeholder('Using post title as SEO title')
                            ->columnSpanFull(),
                        TextEntry::make('seo_description')
                            ->placeholder('Using post excerpt as SEO description')
                            ->columnSpanFull(),
                    ]),

                // Content Section
                Section::make('Content')
                    ->icon('heroicon-o-document')
                    ->schema([
                        TextEntry::make('body')
                            ->placeholder('No content available')
                            ->columnSpanFull()
                            ->hiddenLabel()
                            ->markdown(),
                    ])->columnSpanFull(),
            ]);
    }
}
