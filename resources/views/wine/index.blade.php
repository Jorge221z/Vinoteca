<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vinos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('wines.create') }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Añadir Vino') }}
                    </a>
                    @if($wines->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            @foreach($wines as $wine)
                                <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 relative">

                                    <x-wine-image :wine="$wine"/>

                                        <div class="flex flex-col p-4 leading-normal">

                                            <x-wine-name-and-category :wine="$wine"/>

                                            <div class="border-b border-gray-300 dark:border-gray-600 mb-3"></div>

                                            <x-wine-info :wine="$wine"/>


                                            <div class="absolute bottom-0 right-0 p-4 flex justify-between">
                                                <a href="{{ route('wines.edit', $wine) }}"
                                                   class="bg-purple-500 hover:bg-purple-700 text-white font-bold p-1 rounded mb-2 md:mb-0 text-center">
                                                    Editar
                                                </a>
                                                <form action="{{ route('wines.destroy', $wine) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="bg-red-500 hover:bg-red-700 text-white font-bold p-1 rounded w-full md:w-auto ms-2">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">¡Lo siento!</strong>
                            <span class="block sm:inline">No hay vinos creados aún.</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

