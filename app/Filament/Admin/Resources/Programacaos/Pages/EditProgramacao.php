<?php

namespace App\Filament\Admin\Resources\Programacaos\Pages;

use App\Filament\Admin\Resources\Programacaos\ProgramacaoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProgramacao extends EditRecord
{
    protected static string $resource = ProgramacaoResource::class;

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
