<?php

namespace App\Filament\Admin\Resources\Imovels\Pages;

use App\Filament\Admin\Resources\Imovels\ImovelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListImovels extends ListRecords
{
    protected static string $resource = ImovelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
