<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use NiekPH\LaravelPostsFilament\Filament\Resources\Categories\CategoryResource;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),

                TextEntry::make('slug'),

                TextEntry::make('url')
                    ->url(fn ($state) => $state)
                    ->color('primary'),

                TextEntry::make('parent_category.name')
                    ->label('Parent category')
                    ->placeholder('-')
                    ->url(fn (?Model $record) => ! is_null($id = $record->getAttribute('parent_category_id')) ?
                        CategoryResource::getUrl('view', ['record' => $id])
                        :
                        null
                    )
                    ->color('primary'),

                KeyValueEntry::make('metadata'),

                TextEntry::make('description')
                    ->placeholder('-'),

                TextEntry::make('sort_order')
                    ->numeric()
                    ->placeholder('-'),

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
                            ->placeholder('Using category name as SEO title')
                            ->columnSpanFull(),
                        TextEntry::make('seo_description')
                            ->placeholder('Using category description as SEO description')
                            ->columnSpanFull(),
                    ]),

                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
