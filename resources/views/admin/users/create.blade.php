<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div>
                <h2 class="text-xl font-semibold text-[#1F2937]">
                    Crear Usuario
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10 px-4 sm:px-6">
        <div class="max-w-2xl mx-auto">
            <!-- Form Card -->
            <div class="relative overflow-hidden rounded-2xl border border-white/60 bg-white/70 backdrop-blur">
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-[#FBCFE8]/60 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-[#E9D5FF]/60 blur-2xl"></div>
                
                <div class="relative p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="h-6 w-1 rounded-full bg-gradient-to-b from-[#7C3AED] to-[#F472B6]"></div>
                        <h3 class="text-lg font-bold text-[#1F2937]">Información del Usuario</h3>
                    </div>

                    @include('admin.users.form', ['user' => null])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>