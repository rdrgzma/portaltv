<?php

namespace App\Filament\Admin\Resources\Anuncios\Pages;

use App\Filament\Admin\Resources\Anuncios\AnuncioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAnuncio extends EditRecord
{
    protected static string $resource = AnuncioResource::class;

    public function getTitle(): string
    {
        $nome = $this->record?->anunciante?->nome ?? "#{$this->record?->id}";
        return "Editar Anúncio — {$nome}";
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->label('Excluir anúncio'),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
