<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Panel del Cliente
        </h2>
    </x-slot>

    <meta http-equiv="Cache-Control" content="no-store" />

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Tarjeta: Pedidos realizados --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Pedidos Realizados</h3>
                <p class="mt-3 text-3xl font-bold text-green-600 dark:text-green-400">12</p>
            </div>

            {{-- Tarjeta: Pedidos pendientes --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Pedidos Pendientes</h3>
                <p class="mt-3 text-3xl font-bold text-red-600 dark:text-red-400">3</p>
            </div>

            {{-- Tarjeta: Total Gastado --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Gastado</h3>
                <p class="mt-3 text-3xl font-bold text-indigo-600 dark:text-indigo-400">$1.245</p>
            </div>

        </div>

        {{-- Sección inferior --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Bienvenido, {{ auth()->user()->name }}</h3>
                <p class="mb-4">
                    Desde este panel puedes ver tus pedidos, realizar nuevos pedidos o cotizaciones y administrar tu información personal.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <a href="#" class="flex items-center justify-center p-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow transition">
                        Ver Pedidos
                    </a>
                    <a href="#" class="flex items-center justify-center p-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition">
                        Hacer Pedido/Cotización
                    </a>
                    <a href="#" class="flex items-center justify-center p-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">
                        Mi Perfil
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
