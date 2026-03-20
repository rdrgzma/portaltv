<?php

namespace App\Filament\Admin\Resources\Programacaos\Pages;

use App\Filament\Admin\Resources\Programacaos\ProgramacaoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProgramacaos extends ListRecords
{
    protected static string $resource = ProgramacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
