<nav class="bg-gray-900/70 backdrop-blur-md border-b border-gray-700/50 py-3">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">

        {{-- Logo / Ir al Dashboard --}}
        <a href="{{ route('cliente.dashboard') }}" class="text-white text-lg font-bold">
            MiNegocioApp
        </a>

        {{-- Enlaces de navegación --}}
        <ul class="hidden sm:flex gap-6 text-gray-300 font-medium">
            
            <li>
                <a href="{{ url('cliente.dashboard') }}"
                   class="hover:text-white transition">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ url('cliente.productos.index') }}"
                   class="hover:text-white transition">
                    Productos
                </a>
            </li>

            <li>
                <a href="{{ url('cliente.pedidos.index') }}"
                   class="hover:text-white transition">
                    Pedidos
                </a>
            </li>

            <li>
                <a href="{{ url('profile.edit') }}"
                   class="hover:text-white transition">
                    Mi Perfil
                </a>
            </li>

        </ul>

        {{-- Carrito --}}
        <a href="{{ url('cliente.carrito.index') }}" 
           class="relative text-gray-300 hover:text-white transition">

            {{-- Ícono carrito --}}
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 3h2l.4 2m0 0L7 13h10l4-8H5.4m0 0L7 13m10 0a2 2 0 100 4 2 2 0 000-4m-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>

            {{-- Cantidad en carrito --}}
            @if(isset($cartCount) && $cartCount > 0)
                <span
                    class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1.5 py-0.5 rounded-full">
                    {{ $cartCount }}
                </span>
            @endif

        </a>
    </div>
</nav>
