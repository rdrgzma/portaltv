<?php

namespace App\Filament\Admin\Resources\Planos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PlanoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->required(),
                TextInput::make('valor')
                    ->required()
                    ->numeric(),
                TextInput::make('limite_videos')
                    ->numeric(),
                TextInput::make('limite_imoveis')
                    ->numeric(),
                TextInput::make('limite_anuncios')
                    ->numeric(),
                Toggle::make('ativo')
                    ->required(),
            ]);
    }
}
