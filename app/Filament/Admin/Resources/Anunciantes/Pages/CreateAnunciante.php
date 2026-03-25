<?php

namespace App\Filament\Admin\Resources\Anunciantes\Pages;

use App\Filament\Admin\Resources\Anunciantes\AnuncianteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAnunciante extends CreateRecord
{
    protected static string $resource = AnuncianteResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
