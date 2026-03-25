<?php

namespace App\Filament\Admin\Resources\Imovels\Pages;

use App\Filament\Admin\Resources\Imovels\ImovelResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditImovel extends EditRecord
{
    protected static string $resource = ImovelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
