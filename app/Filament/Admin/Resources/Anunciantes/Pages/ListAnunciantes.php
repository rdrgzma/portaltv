<?php

namespace App\Filament\Admin\Resources\Anunciantes\Pages;

use App\Filament\Admin\Resources\Anunciantes\AnuncianteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAnunciantes extends ListRecords
{
    protected static string $resource = AnuncianteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
