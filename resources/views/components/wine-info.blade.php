@props(['wine'])

<p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
    {{ __('Precio/Unidad') }}: {{ $wine->formatted_Price }}
</p>
<p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
    {{ __('Cosecha') }}: {{ $wine->year }}
</p>
<p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
    {{ __('Stock: :count unidades', ['count' => $wine->stock]) }}
</p>
<p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
    {{ $wine->description }}
</p>
