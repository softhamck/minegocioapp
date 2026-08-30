@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-[#374151] mb-2']) }}>
    {{ $value ?? $slot }}
</label>