<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Productos</h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow">
        <table class="w-full text-sm">
            <thead class="border-b bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Negocio</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Precio</th>
                    <th class="px-4 py-2 text-left">Cantidad</th>
                    <th class="px-4 py-2 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $product->business->name ?? 'Sin negocio' }}</td>
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">${{ number_format($product->price, 0) }}</td>
                        <td class="px-4 py-2">{{ $product->quantity }}</td>
                        <td class="px-4 py-2 text-right">
                            <a href="#" class="text-blue-600 hover:underline">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
 -->