<div>
    <div class="flex h-16">
        <input type="text" class="ml-[20em] mt-4" placeholder="Buscar..." wire:model="criterio" wire:keydown='buscar'>
    </div>
    <div>
        @if ($productos->count() > 0)
            <table class="w-8/12 mx-auto mt-4 text-sm text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-3/4">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            Nombre del producto
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Precio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($productos as $producto)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{ route('productos.show', $producto) }}">{{ $producto->nombre }}</a>
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $producto->precio }}€
                            </td>
                            <td>
                                <div class="flex justify-center">
                                    <form action="{{ route('productos.add', $producto) }}" method="POST"
                                        class="inline-block mr-2">
                                        @csrf
                                        <button type="submit"
                                            class="text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-md text-xl">+</button>
                                    </form>
                                    <form action="{{ route('productos.resta', $producto) }}" method="POST"
                                        class="inline-block text-xl">
                                        @csrf
                                        <button type="submit"
                                            class="text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-md">-</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay resultados</p>
        @endif
    </div>
</div>
