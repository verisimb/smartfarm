<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-white border border-slate-200 rounded-full font-bold text-sm text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-100 disabled:opacity-25 transition duration-150 cursor-pointer']) }}>
    {{ $slot }}
</button>
