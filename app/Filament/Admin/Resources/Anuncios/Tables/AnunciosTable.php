<?php

namespace App\Filament\Admin\Resources\Anuncios\Tables;

use App\Models\Anuncio;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class AnunciosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('anunciante.nome')
                    ->label('Anunciante')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tipo')
                    ->label('Posição')
                    ->searchable(),

                // Badge do tipo de mídia — clicável para alternar exibir_midia
                TextColumn::make('exibir_midia')
                    ->label('Exibindo')
                    ->badge()
                    ->color(fn (Anuncio $record): string => match ($record->tipoMidia()) {
                        'video'   => 'warning',
                        'imagem'  => 'success',
                        'youtube' => 'danger',
                        default   => 'gray',
                    })
                    ->formatStateUsing(fn (Anuncio $record): string => match ($record->tipoMidia()) {
                        'video'   => '🎬 Vídeo',
                        'imagem'  => '🖼️ Imagem',
                        'youtube' => '▶️ YouTube',
                        default   => '— Sem mídia',
                    })
                    ->action(function (Anuncio $record): void {
                        // Alterna entre 'arquivo' e 'youtube' ao clicar no badge
                        $record->update([
                            'exibir_midia' => $record->exibir_midia === 'youtube' ? 'arquivo' : 'youtube',
                        ]);
                    })
                    ->tooltip('Clique para alternar entre arquivo e YouTube'),

                TextColumn::make('youtube_url')
                    ->label('YouTube')
                    ->limit(35)
                    ->url(fn (Anuncio $record) => $record->youtube_url)
                    ->openUrlInNewTab()
                    ->toggleable(),

                TextColumn::make('inicio')
                    ->label('Início')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('fim')
                    ->label('Fim')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('prioridade')
                    ->numeric()
                    ->sortable(),

                // Toggle clicável direto na tabela para ativo/inativo
                ToggleColumn::make('ativo')
                    ->label('Ativo'),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->label('Editar anúncio'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
