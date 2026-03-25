<?php

namespace App\Filament\Admin\Resources\Anunciantes\Pages;

use App\Filament\Admin\Resources\Anunciantes\AnuncianteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAnunciante extends EditRecord
{
    protected static string $resource = AnuncianteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
