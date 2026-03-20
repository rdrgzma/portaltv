<?php

namespace App\Filament\Admin\Resources\Noticias\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str; // Importar classe de String do Laravel


class NoticiaForm
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
                    Select::make('categoria')
                    ->label('Categoria')
                    ->options([
                        'politica' => 'Política',
                        'esportes' => 'Esportes',
                        'entretenimento' => 'Entretenimento',
                        'tecnologia' => 'Tecnologia',
                        'saude' => 'Saúde', 
                        'negocios' => 'Negócios',
                        'curiosidades' => 'Curiosidades',
                        'geral' => 'Geral',
                    ])
                    ->required(),
                Textarea::make('resumo')
                    ->columnSpanFull(),
                RichEditor::make('conteudo')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('imagem')
                    ->disk('public')
                    ->image()
                    ->imageEditor(),
                Toggle::make('destaque')
                    ->required(),
                Toggle::make('ativo')
                    ->required(),
                DateTimePicker::make('publicado_em'),
            ]);
    }
}
