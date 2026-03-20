<?php

namespace App\Filament\Admin\Resources\Videos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

use Filament\Forms\Components\MorphToSelect;
use App\Models\Admin;
use App\Models\User;

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Detalhes do Vídeo')
                    ->columns(2)
                    ->schema([
                        MorphToSelect::make('responsible')
                            ->label('Responsável')
                            ->types([
                                MorphToSelect\Type::make(User::class)
                                    ->label('Usuário')
                                    ->titleAttribute('name'),
                                MorphToSelect\Type::make(Admin::class)
                                    ->label('Administrador')
                                    ->titleAttribute('name'),
                            ])
                            ->searchable()
                            ->preload()
                            ->required()
                            ->default(fn () => [
                                'responsible_id' => auth()->id(),
                                'responsible_type' => auth()->user()::class,
                            ])
                            ->columnSpanFull(),

                        TextInput::make('titulo')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('youtube_url')
                            ->label('URL do YouTube')
                            ->url()
                            ->required()
                            ->helperText('Cole o link completo. O ID será extraído ao salvar.')
                            ->suffixIcon('heroicon-m-link'),

                        TextInput::make('youtube_video_id')
                            ->label('ID do Vídeo')
                            ->disabled() // O Observer preenche isso
                            ->dehydrated() // Garante que o valor seja processado
                            ->placeholder('Gerado automaticamente'),

                        TextInput::make('duracao')
                            ->label('Duração (segundos)')
                            ->numeric()
                            ->minValue(1)
                            ->suffix('seg'),

                        // Agrupamento dos Toggles para ficarem alinhados
                        Section::make('Visibilidade')
                            ->schema([
                                Toggle::make('aprovado')
                                    ->label('Aprovado')
                                    ->default(false)
                                    ->onColor('success'),

                                Toggle::make('ativo')
                                    ->label('Ativo')
                                    ->default(true)
                                    ->onColor('primary'),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
