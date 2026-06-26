@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-bold text-sm text-emerald-600 bg-emerald-50 border border-emerald-200/50 px-4 py-2.5 rounded-2xl mb-4']) }}>
        {{ $status }}
    </div>
@endif
