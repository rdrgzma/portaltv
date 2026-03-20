<?php

namespace App\Filament\Admin\Resources\Pagamentos\Pages;

use App\Filament\Admin\Resources\Pagamentos\PagamentosResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPagamentos extends EditRecord
{
    protected static string $resource = PagamentosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
