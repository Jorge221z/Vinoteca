@props(['wine'])

<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
    {{ $wine->name }}
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
        {{ __('Categoría') }}: {{ $wine->category->name }}
    </span>


</h5>
