<?php

namespace App\Filament\Admin\Resources\Anunciantes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AnuncianteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('telefone')
                    ->tel(),
            ]);
    }
}
