@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-xs font-bold text-slate-800 uppercase tracking-widest mb-2']) }}>
    {{ $value ?? $slot }}
</label>
