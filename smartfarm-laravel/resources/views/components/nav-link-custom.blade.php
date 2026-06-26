@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium bg-emerald-50 text-emerald-700 transition-all duration-300'
            : 'flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all duration-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <i class="hgi-stroke {{ $icon }} text-lg"></i>
    @endif
    <span>{{ $slot }}</span>
</a>
