<?php

namespace App\Filament\Admin\Resources\Imovels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
// use Filament\Forms\Set; // <--- NÃO PRECISA MAIS IMPORTAR ISSO

class ImovelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->required()
                    ->live(onBlur: true)
                    // REMOVIDO A TIPAGEM 'Set' AQUI EMBAIXO:
                    ->afterStateUpdated(fn ($set, ?string $state) => 
                        $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->unique(ignoreRecord: true),

                Textarea::make('descricao')
                    ->columnSpanFull(),
                Select::make('tipo')
                    ->options([
                        'casa' => 'Casa',
                        'apartamento' => 'Apartamento',
                        'sobrado' => 'Sobrado',
                        'terreno' => 'Terreno',
                        'comercial' => 'Comercial',

                    ])
                    ->required(),
                TextInput::make('valor')
                    ->numeric(),
                TextInput::make('quartos')
                    ->numeric(),
                TextInput::make('banheiros')
                    ->numeric(),
                TextInput::make('garagem')
                    ->numeric(),
                TextInput::make('area')
                    ->numeric(),
                TextInput::make('localizacao'),
                TextInput::make('youtube_url')
                    ->url(),
                Toggle::make('destaque')
                    ->required(),
                Toggle::make('ativo')
                    ->required(),
                Repeater::make('imagens')
                    ->relationship()
                    ->schema([
                        FileUpload::make('imagem')
                            ->disk('public')
                            ->image()
                            ->imageEditor()
                            ->required(),
                        TextInput::make('ordem')
                            ->numeric()
                            ->default(1)
                            ->required(),
                    ])
                    ->collapsed()
                    ->columnSpanFull()
                    ->createItemButtonLabel('Adicionar Imagem')
                    ->orderable('ordem'),
            ]);
    }
}