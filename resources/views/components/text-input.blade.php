@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'w-full px-4 py-3 bg-white border border-[#E9D5FF] rounded-lg text-[#1F2937] placeholder-[#9CA3AF] focus:border-[#C4B5FD] focus:ring-2 focus:ring-[#C4B5FD]/25 transition-all duration-300'
]) !!}>