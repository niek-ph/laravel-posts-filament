<?php

namespace NiekPH\LaravelPostsFilament\Filament\Components;

use Filament\Forms\Components\Select;
use NiekPH\LaravelPosts\Facades\LaravelPosts;

class CategorySelector extends Select
{
    protected string $view = 'filament-forms::components.select';

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Category')
            ->options(function () {
                $categories = LaravelPosts::getCategoryTree();

                return self::flattenCategoryTree($categories);
            })
            ->searchable()
            ->placeholder('Select a category...')
            ->getSearchResultsUsing(function (string $search) {
                $categories = LaravelPosts::getCategoryTree();
                $flattened = self::flattenCategoryTree($categories);

                return collect($flattened)
                    ->filter(fn ($label, $id) => str_contains(strtolower($label), strtolower($search))
                    )
                    ->take(10)
                    ->toArray();
            });
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
