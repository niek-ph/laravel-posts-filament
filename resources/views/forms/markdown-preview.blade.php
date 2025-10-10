<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div class="prose prose-sm dark:prose-invert max-w-none">
        {!! str($get('body'))->markdown()->sanitizeHtml() !!}
    </div>
</x-dynamic-component>
