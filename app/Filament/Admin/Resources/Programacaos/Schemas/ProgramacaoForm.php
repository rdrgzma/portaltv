<?php

namespace App\Filament\Admin\Resources\Programacaos\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use App\Models\Video;
use Carbon\Carbon;

class ProgramacaoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('video_id')
                    ->relationship('video', 'titulo')
                    ->required()
                    ->searchable()
                            ->preload()
                            ->required()
                            ->live() // Reage a mudanças para recalcular o tempo
                            ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                self::updateFim($get, $set);
                            }),
                DateTimePicker::make('inicio')
                            ->label('Início da Exibição')
                            ->required()
                            ->seconds(false)
                            ->default(now())
                            ->live() // Reage para recalcular o fim
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                self::updateFim($get, $set);
                            }),
                DateTimePicker::make('fim')
                ->label('Fim (Calculado)')
                            ->required()
                            ->readOnly()
                            ->helperText('Calculado automaticamente com base na duração do vídeo.'),
               Select::make('status')
                            ->options([
                                'agendado' => 'Agendado',
                                'transmitindo' => 'Transmitindo Agora',
                                'finalizado' => 'Finalizado',
                            ])
                            ->default('agendado')
                            ->required(),
                TextInput::make('prioridade')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    /**
     * Função auxiliar para calcular a data de fim
     */
    public static function updateFim(Get $get, Set $set): void
    {
        $videoId = $get('video_id');
        $inicio = $get('inicio');

        if ($videoId && $inicio) {
            $video = Video::find($videoId);
            if ($video && $video->duracao) {
                $dataInicio = Carbon::parse($inicio);
                // Adiciona a duração do vídeo ao início
                $set('fim', $dataInicio->addSeconds($video->duracao)->toDateTimeString());
            }
        }
    }
}
