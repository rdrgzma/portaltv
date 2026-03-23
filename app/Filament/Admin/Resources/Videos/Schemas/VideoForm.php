<?php

namespace App\Filament\Admin\Resources\Videos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Utilities\Get; // Importação correta para Schemas
use Filament\Schemas\Components\Utilities\Set; // Importação correta para Schemas

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

                        TextInput::make('duracao_formatada')
                            ->label('Duração (HH:MM:SS)')
                            ->placeholder('00:00:00')
                            ->mask('99:99:99') // Máscara para facilitar a entrada
                            ->live(onBlur: true) // Atualiza quando o usuário sai do campo
                            ->afterStateUpdated(function (Set $set, $state) {
                                // Converte a string HH:MM:SS para segundos totais
                                $seconds = 0;
                                $parts = explode(':', $state);
                                
                                if (count($parts) === 3) {
                                    $seconds = ($parts[0] * 3600) + ($parts[1] * 60) + $parts[2];
                                } elseif (count($parts) === 2) {
                                    $seconds = ($parts[0] * 60) + $parts[1];
                                }

                                // Define o valor no campo oculto que vai para o banco
                                $set('duracao', (int) $seconds);
                            })
                            // Formata o valor vindo do banco (segundos) de volta para HH:MM:SS ao editar
                            ->formatStateUsing(fn ($record) => $record ? gmdate("H:i:s", $record->duracao) : '00:00:00')
                            ->dehydrated(false), // Não salva este campo diretamente

                        TextInput::make('duracao')
                            ->label('Total em Segundos')
                            ->numeric()
                            ->readOnly() // Apenas leitura para o usuário ver o cálculo
                            ->helperText('Este valor será salvo no banco de dados.')
                            ->required(),

                        Placeholder::make('exibicao_calculo')
                            ->label('Tempo calculado')
                            ->content(fn (Get $get): string => $get('duracao') . ' segundos totais'),

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
