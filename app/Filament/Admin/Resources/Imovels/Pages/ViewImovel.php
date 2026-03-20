<?php

namespace App\Filament\Admin\Resources\Imovels\Pages;

use App\Filament\Admin\Resources\Imovels\ImovelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewImovel extends ViewRecord
{
    protected static string $resource = ImovelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
