<?php

namespace App\Filament\Admin\Resources\Anuncios\Pages;

use App\Filament\Admin\Resources\Anuncios\AnuncioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAnuncio extends EditRecord
{
    protected static string $resource = AnuncioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
