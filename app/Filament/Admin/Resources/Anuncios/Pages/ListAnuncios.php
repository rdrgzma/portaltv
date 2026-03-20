<?php

namespace App\Filament\Admin\Resources\Anuncios\Pages;

use App\Filament\Admin\Resources\Anuncios\AnuncioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAnuncios extends ListRecords
{
    protected static string $resource = AnuncioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
