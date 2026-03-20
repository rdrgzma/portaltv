<?php

namespace App\Filament\Admin\Resources\Noticias\Pages;

use App\Filament\Admin\Resources\Noticias\NoticiaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNoticia extends CreateRecord
{
    protected static string $resource = NoticiaResource::class;
}
