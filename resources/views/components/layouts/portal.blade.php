@php
    $template = \App\Models\Setting::getValue('template_choice', 'classic');
@endphp

@if($template === 'premium')
    <x-layouts.premium :title="$title ?? null">
        {{ $slot }}
    </x-layouts.premium>
@else
    <x-layouts.classic :title="$title ?? null">
        {{ $slot }}
    </x-layouts.classic>
@endif