<?php

namespace NiekPH\LaravelPostsFilament\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use NiekPH\LaravelPostsFilament\Filament\Components\CategorySelector;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),

                CategorySelector::make('category_id'),
                Select::make('author_id')
                    ->relationship('author', 'name'),

                FileUpload::make('featured_image')
                    ->image(),

                TextInput::make('full_path')
                    ->required(),

                TextInput::make('sort_order')
                    ->numeric(),

                Textarea::make('subtitle')
                    ->columnSpanFull(),

                // Grid layout for markdown editor and live preview
                Grid::make(2)
                    ->schema([
                        MarkdownEditor::make('body')
                            ->label('Content')
                            ->live(onBlur: true)
                            ->columnSpan(1)
                        //                            ->fileAttachmentsDisk('public')
                        //                            ->fileAttachmentsDirectory('attachments')
                        //                            ->fileAttachmentsVisibility('public')
                        ,

                        ViewField::make('body_preview')
                            ->label('Live Preview')
                            ->view('posts-filament::forms.markdown-preview')
                            ->columnSpan(1),
                    ])
                    ->columnSpanFull(),

                KeyValue::make('metadata')
                    ->columnSpanFull(),
                Section::make('SEO')->schema([
                    TextInput::make('seo_title'),
                    Textarea::make('seo_description'),
                ])->columnSpanFull(),

            ]);
    }

    /**
     * Flatten the category tree with breadcrumb paths
     */
    private static function flattenCategoryTree($categories, $path = '', $result = [])
    {
        foreach ($categories as $category) {
            $currentPath = $path ? $path.' > '.$category->name : $category->name;
            $result[$category->id] = $currentPath;

            if (isset($category->child_categories) && $category->child_categories->count() > 0) {
                $result = self::flattenCategoryTree($category->child_categories, $currentPath, $result);
            }
        }

        return $result;
    }
}
