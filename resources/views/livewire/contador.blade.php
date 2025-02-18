<div class="flex w-1/12">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @foreach ($productos as $producto)
        @php
            $total += $producto['cantidad'];
        @endphp
    @endforeach

    <p class="bg-black text-white p-2 rounded-lg m-2">
        Carrito: {{ $total }}
    </p>

</div>
