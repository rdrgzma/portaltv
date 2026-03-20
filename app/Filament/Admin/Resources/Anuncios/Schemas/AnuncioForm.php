<?php

namespace App\Filament\Admin\Resources\Anuncios\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
class AnuncioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('anunciante_id')
                    ->relationship('anunciante', 'nome')
                    ->required(),
                Select::make('tipo')
                    ->options([
                        'banner_horizontal' => 'Banner horizontal',
                        'banner_lateral_direita' => 'Banner lateral',
                        'banner_lateral_esquerda' => 'Banner lateral',
                        'video' => 'Vídeo',
                    ])
                    ->required(),
                FileUpload::make('arquivo')
                    ->required(),
                TextInput::make('link'),
                DatePicker::make('inicio')
                    ->required(),
                DatePicker::make('fim')
                    ->required(),
                TextInput::make('prioridade')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('ativo')
                    ->required(),
            ]);
    }
}
