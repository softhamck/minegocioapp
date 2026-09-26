{{-- Mensajes de confirmación y error compartidos por los paneles --}}
@if(session('success') || session('error'))
<div class="relative z-20 mx-auto max-w-6xl px-4 pt-6 sm:px-6">
    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-300/60 bg-green-50/80 p-4 backdrop-blur">
            <div class="flex items-center text-green-700">
        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 rounded-2xl border border-red-300/60 bg-red-50/80 p-4 backdrop-blur">
            <div class="flex items-center text-red-700">
        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        {{ session('error') }}
            </div>
        </div>
    @endif

</div>
@endif
