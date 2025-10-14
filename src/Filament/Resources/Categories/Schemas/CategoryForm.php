<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use NiekPH\LaravelPosts\Models\Category;
use NiekPH\LaravelPostsFilament\Filament\Components\CategorySelector;
use NiekPH\LaravelPostsFilament\Filament\Resources\Tags\Schemas\TagForm;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->belowContent(function (?Category $record, $state) {
                        if (empty($state)) {
                            return '';
                        }

                        if (! $record->parent_category_id) {
                            return $state;
                        }

                        $fullPath = Str::beforeLast($record->full_path, '/').'/'.$state;

                        return Text::make($fullPath)->size('xs');
                    })
                    ->live(debounce: 500),

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
