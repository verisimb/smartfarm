<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-red-600 border border-transparent rounded-full font-bold text-sm text-white hover:bg-red-700 active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-red-100 transition duration-150 cursor-pointer']) }}>
    {{ $slot }}
</button>
