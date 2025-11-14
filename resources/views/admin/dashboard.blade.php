<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Panel de Administrador
        </h2>
    </x-slot>

    {{-- Evitar que el navegador guarde caché --}}
    <meta http-equiv="Cache-Control" content="no-store" />

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Tarjeta: Total de usuarios --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total de Usuarios</h3>
                <p class="mt-3 text-3xl font-bold text-indigo-600 dark:text-indigo-400">125</p>
            </div>

            {{-- Tarjeta: Emprendedores --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Emprendedores</h3>
                <p class="mt-3 text-3xl font-bold text-green-600 dark:text-green-400">54</p>
            </div>

            {{-- Tarjeta: Clientes --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Clientes Registrados</h3>
                <p class="mt-3 text-3xl font-bold text-blue-600 dark:text-blue-400">71</p>
            </div>

        </div>

        {{-- Sección inferior --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-xl font-semibold mb-3">Bienvenido, {{ auth()->user()->name }}</h3>

                    <p class="mb-4">
                        Desde este panel puedes administrar usuarios, emprendedores y clientes.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

                        {{-- Botón Usuarios --}}
                        <a href="#"
                           class="flex items-center justify-center p-4 bg-indigo-600 hover:bg-indigo-700 
                                  text-white font-semibold rounded-lg shadow transition">
                            Gestión de Usuarios
                        </a>

                        {{-- Botón Emprendedores --}}
                        <a href="#"
                           class="flex items-center justify-center p-4 bg-green-600 hover:bg-green-700
                                  text-white font-semibold rounded-lg shadow transition">
                            Gestión de Emprendedores
                        </a>

                        {{-- Botón Clientes --}}
                        <a href="#"
                           class="flex items-center justify-center p-4 bg-blue-600 hover:bg-blue-700
                                  text-white font-semibold rounded-lg shadow transition">
                            Gestión de Clientes
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
