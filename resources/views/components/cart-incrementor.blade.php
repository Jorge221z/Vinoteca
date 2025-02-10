@props(['item', 'action', 'hidden_key'])

<form action="{{ $action }}" method="POST" class="ms-2 inline">
    @csrf
    <input type="hidden" name="wine_id" value="{{ data_get($item, $hidden_key) }}">

    <button type="submit"
            class="bg-green-500 hover:bg-green-700 text-white font-bold p-1 rounded mb-2 py-4 px-5 md:mb-0 text-center text-xs"
        >
        +
        </button>
</form>
