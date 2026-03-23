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
                        'banner_horizontal' => 'Inferior Horizontal',
                        'banner_lateral_direita' => 'Lateral Direita (Vertical)',
                        'banner_lateral_esquerda' => 'Lateral Esquerda (Vertical)',
                    ])
                    ->required(),
                FileUpload::make('arquivo')
                    ->label('Mídia (Imagem ou Vídeo)')
                    ->directory('anuncios')
                    ->acceptedFileTypes(['image/*', 'video/mp4', 'video/webm', 'video/ogg']) // Aceita imagens e vídeos
                    ->maxSize(20480) // Limite de 20MB para suportar vídeos curtos
                    ->required(),
                TextInput::make('link')
                    ->url(),
                DatePicker::make('inicio')
                    ->required(),
                DatePicker::make('fim')
                    ->required(),
                TextInput::make('prioridade')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('ativo')
                    ->default(true)
                    ->required(),
            ]);
    }
}
