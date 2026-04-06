<a {{ $attributes->merge([
    'class' => 'block w-full rounded-xl px-3 py-2 text-left text-sm font-medium text-[#374151] transition duration-200 ease-in-out hover:bg-[#F5F3FF] hover:text-[#7C3AED] focus:outline-none focus:bg-[#F5F3FF] focus:text-[#7C3AED]'
]) }}>
    {{ $slot }}
</a>