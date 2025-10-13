<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Schemas;

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
                    ->live(debounce: 200)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->belowContent(function (?Model $record, $state) {
                        if (empty($state)) {
                            return '';
                        }

                        $fullPath = Str::beforeLast($record->full_path, '/') . '/' . $state;

                        return Text::make($fullPath)->size('xs');
                    })
                    ->live(debounce: 200),


                CategorySelector::make('category_id'),

                Select::make('author_id')
                    ->relationship('author', 'name'),

                FileUpload::make('featured_image')
                    ->image(),

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

                MarkdownEditor::make('excerpt')
                    ->label('Excerpt')
                    ->maxHeight('75px')
                    ->columnSpanFull(),

                MarkdownEditor::make('body')
                    ->label('Content')
                    ->live(onBlur: true)
                    ->columnSpanFull()
                    ->maxHeight('500px'),
                // Grid layout for markdown editor and live preview
//                Grid::make(2)
//                    ->schema([
//                        MarkdownEditor::make('body')
//                            ->label('Content')
//                            ->live(debounce: 200)
//                            ->columnSpan(1)
////                            ->fileAttachmentsDisk('public')
////                            ->fileAttachmentsDirectory('attachments')
////                            ->fileAttachmentsVisibility('public')
//                        ,
//
//                        ViewField::make('body_preview')
//                            ->label('Live Preview')
//                            ->view('posts-filament::forms.markdown-preview')
//                            ->disabled()
//                            ->columnSpan(1),
//                    ])
//                    ->columnSpanFull(),


                KeyValue::make('metadata')
                    ->columnSpanFull(),
                Section::make('SEO')->schema([
                    TextInput::make('seo_title'),
                    Textarea::make('seo_description'),
                ])->columnSpanFull(),

            ]);
    }


}
