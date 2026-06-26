<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-emerald-600 border border-transparent rounded-full font-bold text-sm text-white transition-all hover:bg-emerald-700 active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-emerald-500/20 disabled:opacity-50 cursor-pointer']) }}>
    {{ $slot }}
</button>
