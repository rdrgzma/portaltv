<?php

namespace App\Filament\Admin\Resources\Pagamentos\Pages;

use App\Filament\Admin\Resources\Pagamentos\PagamentoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPagamentos extends ListRecords
{
    protected static string $resource = PagamentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
