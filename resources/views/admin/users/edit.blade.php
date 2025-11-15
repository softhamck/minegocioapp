<x-app-layout>
    <x-slot name="header"><h2>Editar Usuario</h2></x-slot>

    <div class="p-6 bg-white shadow rounded-lg">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @method('PUT')
            @include('admin.users.form')
        </form>
    </div>
</x-app-layout>
