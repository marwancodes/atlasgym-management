@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'flex items-center px-4 py-2 w-full text-sm font-medium text-white bg-indigo-100 rounded-md focus:outline-none hover:bg-zinc-700 focus:bg-zinc-700 transition duration-150 ease-in-out'
        : 'flex items-center px-4 py-2 w-full text-sm font-medium text-gray-400 hover:text-white hover:bg-zinc-700 rounded-md focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
