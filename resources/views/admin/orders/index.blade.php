<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Órdenes</h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow">
        <table class="w-full text-sm">
            <thead class="border-b bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Negocio</th>
                    <th class="px-4 py-2 text-left">Cliente</th>
                    <th class="px-4 py-2 text-left">Estado</th>
                    <th class="px-4 py-2 text-left">Número</th>
                    <th class="px-4 py-2 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $order->business->name ?? 'Sin negocio' }}</td>
                        <td class="px-4 py-2">{{ $order->customer->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $order->status->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $order->numeroOrden }}</td>
                        <td class="px-4 py-2 text-right">${{ number_format($order->total, 0) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>
 -->