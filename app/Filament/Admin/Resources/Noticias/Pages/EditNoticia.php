<?php

namespace App\Filament\Admin\Resources\Noticias\Pages;

use App\Filament\Admin\Resources\Noticias\NoticiaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditNoticia extends EditRecord
{
    protected static string $resource = NoticiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
