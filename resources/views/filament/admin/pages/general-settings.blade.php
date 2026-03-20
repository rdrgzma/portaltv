<x-filament-panels::page>
    <form wire:submit="submit">
        {{ $this->form }}

        <div class="mt-6 flex justify-end">
             <x-filament::button type="submit">
                 Salvar Alterações
             </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
