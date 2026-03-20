<?php

namespace App\Filament\Admin\Resources\Pagamentos\Pages;

use App\Filament\Admin\Resources\Pagamentos\PagamentosResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPagamentos extends ViewRecord
{
    protected static string $resource = PagamentosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
