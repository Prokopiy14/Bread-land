<input
    id="remember_me"
    type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
    name="remember"
    {{ $attributes->merge(['value'=>1,'checked'=>false]) }}
>
