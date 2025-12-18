<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use NiekPH\LaravelPostsFilament\Filament\Components\CategorySelector;
use NiekPH\LaravelPostsFilament\Filament\Resources\Tags\Schemas\TagForm;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                Select::make('tags')
                    ->label('Tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm(function (Schema $schema) {
                        return TagForm::configure($schema);
                    }),

                CategorySelector::make('parent_category_id'),

                TextInput::make('sort_order')
                    ->numeric(),

                FileUpload::make('featured_image')
                    ->image()
                    ->imageEditor()
                    ->disk(config('posts-filament.uploads.disk', 'public'))
                    ->directory(config('posts-filament.uploads.directory'))
                    ->maxSize(config('posts-filament.uploads.file_size'))
                    ->columnSpanFull(),

                KeyValue::make('metadata')
                    ->columnSpanFull(),

                Section::make('SEO')->schema([
                    TextInput::make('seo_title'),
                    Textarea::make('seo_description'),
                ])->columnSpanFull(),

                MarkdownEditor::make('description')
                    ->toolbarButtons([
                        ['bold', 'italic', 'strike', 'link'],
                        ['heading'],
                        ['blockquote', 'bulletList', 'orderedList'],
                        ['undo', 'redo'],
                    ])
                    ->hiddenLabel()
                    ->label('Description')
                    ->maxHeight('75px')
                    ->columnSpanFull(),
            ]);
    }
}
