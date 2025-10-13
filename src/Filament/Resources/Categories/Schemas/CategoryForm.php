<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('full_path')
                    ->required(),
                TextInput::make('depth')
                    ->numeric(),
                Textarea::make('metadata')
                    ->columnSpanFull(),
                TextInput::make('description'),
                TextInput::make('sort_order')
                    ->numeric(),
                FileUpload::make('featured_image')
                    ->image(),
                TextInput::make('seo_title'),
                Textarea::make('seo_description')
                    ->columnSpanFull(),
                Select::make('parent_category_id')
                    ->relationship('parentCategory', 'name'),
            ]);
    }
}
