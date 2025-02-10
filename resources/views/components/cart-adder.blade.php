@props(['wine', 'action'])

<form action="{{ $action }}" method="POST">
    @csrf
    <input type="hidden" name="wine_id" value="{{ data_get($wine, 'id') }}">
    <button type="submit"
            class="bg-green-500 hover:bg-green-600 text-white dark:text-gray-200 font-bold py-2 px-4 rounded mb-2 md:mb-0 text-center text-base"
            >
                {{ __('Añadir al carrito') }}
    </button>
</form>

