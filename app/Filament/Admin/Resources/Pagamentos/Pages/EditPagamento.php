<?php

namespace App\Filament\Admin\Resources\Pagamentos\Pages;

use App\Filament\Admin\Resources\Pagamentos\PagamentoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPagamento extends EditRecord
{
    protected static string $resource = PagamentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
