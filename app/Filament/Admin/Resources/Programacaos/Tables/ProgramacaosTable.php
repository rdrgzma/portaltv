<?php

namespace App\Filament\Admin\Resources\Programacaos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProgramacaosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('video.titulo')
                    ->label('Vídeo')
                    ->searchable(),
                TextColumn::make('inicio')
                    ->label('Início')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('fim')
                    ->label('Fim')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'agendado' => 'gray',
                        'transmitindo' => 'success',
                        'finalizado' => 'danger',
                    })
                    ->searchable(),
                TextColumn::make('prioridade')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
