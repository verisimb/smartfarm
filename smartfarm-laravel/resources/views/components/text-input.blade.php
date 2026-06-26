@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-2xl border border-slate-200/80 bg-white px-4 py-3 text-sm transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10']) }}>
