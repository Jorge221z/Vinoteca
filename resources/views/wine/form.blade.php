<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method($method)

                    <div class="mb-4">
                        <label for="name" class="block text-white text-sm font-bold md-2">Nombre</label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $wine->name) }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                            >
                            @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                    </div>


                    <div class="mb-4">
                        <label for="category_id" class="block text-white text-sm font-bold mb-2">Categoría</label>
                        <select name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 x-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">-- Seleccione una categoría</option>
                            @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $wine->category_id) == $category->id ?'selected' : '' }}>
                                {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="year" class="block text-white text-sm font-bold mb-2">Año</label>
                        <input type="number"
                               name="year"
                               id="year"
                               value="{{ old('year', $wine->year) }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                               >
                            @error('year')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-white text-sm font-bold mb-2">Precio</label>
                        <input type="number"
                            name="price"
                            id="price"
                            value="{{ old('price', $wine->price) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                            >
                        @error('price')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="stock" class="block text-white text-sm font-bold mb-2">Cantidad</label>
                        <input type="number"
                            name="stock"
                            id="stock"
                            value="{{ old('stock', $wine->stock) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                            >
                        @error('stock')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-white text-sm font-bold mb-2">Imagen</label>
                        <input type="file"
                            name="image"
                            id="image"
                            value="{{ old('image', $wine->image) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                            >
                        @error('image')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-white text-sm font-bold mb-2">Descripcion</label>
                        <input type="text"
                            name="description"
                            id="description"
                            value="{{ old('description', $wine->description) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                            >
                        @error('description')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <a href="{{route('wines.index')}}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Cancelar
                        </a>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-wgite font-bold py-2 px-4 ms-2 rounded">
                            {{ $submit }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
