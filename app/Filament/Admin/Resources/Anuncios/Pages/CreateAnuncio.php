<?php

namespace App\Filament\Admin\Resources\Anuncios\Pages;

use App\Filament\Admin\Resources\Anuncios\AnuncioResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAnuncio extends CreateRecord
{
    protected static string $resource = AnuncioResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
