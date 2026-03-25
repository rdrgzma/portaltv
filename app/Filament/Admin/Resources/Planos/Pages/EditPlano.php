<?php

namespace App\Filament\Admin\Resources\Planos\Pages;

use App\Filament\Admin\Resources\Planos\PlanoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPlano extends EditRecord
{
    protected static string $resource = PlanoResource::class;

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
