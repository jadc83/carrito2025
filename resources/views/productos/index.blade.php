<x-app-layout>
    <div>
        <livewire:buscador />
    </div>
    <div class="flex justify-center w-full mt-4">
        <form action="{{ route('productos.create') }}" method="GET">
            <button type="submit" class="text-white p-2 bg-purple-600 rounded-lg text-center">
                Nuevo producto
            </button>
        </form>
    </div>
</x-app-layout>
