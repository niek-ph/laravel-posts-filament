<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use NiekPH\LaravelPostsFilament\Filament\Components\CategorySelector;
use NiekPH\LaravelPostsFilament\Filament\Resources\Tags\Schemas\TagForm;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->belowContent(function (?Model $record, $state) {
                        if (empty($state) || is_null($record)) {
                            return '';
                        }

                        $fullPath = Str::beforeLast($record->getAttribute('full_path'), '/').'/'.$state;

                        return Text::make($fullPath)->size('xs');
                    })
                    ->live(debounce: 500),

                CategorySelector::make('category_id'),

                Select::make('author_id')
                    ->relationship('author', 'name'),

                TextInput::make('sort_order')
                    ->numeric(),

                Select::make('tags')
                    ->label('Tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm(function (Schema $schema) {
                        return TagForm::configure($schema);
                    }),

                FileUpload::make('featured_image')
                    ->image()
                    ->imageEditor()
                    ->visibility('public')
                    ->disk(config('posts-filament.uploads.disk', 'public'))
                    ->directory(config('posts-filament.uploads.directory'))
                    ->maxSize(config('posts-filament.uploads.file_size'))
                    ->columnSpanFull(),

                KeyValue::make('metadata')
                    ->columnSpanFull(),

                Section::make('SEO')
                    ->schema([
                        TextInput::make('seo_title'),
                        Textarea::make('seo_description'),
                    ])->columnSpanFull(),

                Section::make('Excerpt')
                    ->schema([
                        MarkdownEditor::make('excerpt')
                            ->toolbarButtons([
                                ['bold', 'italic', 'strike', 'link'],
                                ['heading'],
                                ['blockquote', 'bulletList', 'orderedList'],
                                ['undo', 'redo'],
                            ])
                            ->hiddenLabel()
                            ->label('Excerpt')
                            ->maxHeight('75px')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Section::make('Content')
                    ->schema([
                        Grid::make()
                            ->gridContainer()
                            ->columnSpanFull()
                            ->schema([
                                MarkdownEditor::make('body')
                                    ->fileAttachmentsDisk(config('posts-filament.uploads.disk', 'public'))
                                    ->fileAttachmentsDirectory(config('posts-filament.uploads.directory'))
                                    ->fileAttachmentsAcceptedFileTypes(config('posts-filament.uploads.mimes', ['image/png', 'image/jpeg', 'image/gif', 'image/webp']))
                                    ->fileAttachmentsMaxSize(config('posts-filament.uploads.file_size'))
                                    ->hiddenLabel()
                                    ->live(debounce: 200),

                                TextEntry::make('body_preview')
                                    ->hiddenLabel()
                                    ->disabled()
                                    ->state(fn (Get $get) => $get('body'))
                                    ->markdown()
                                    ->placeholder('-'),

                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
