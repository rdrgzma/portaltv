<?php

namespace App\Filament\Admin\Resources\Videos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VideosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('responsible.name')
                    ->label('Responsável')
                    ->searchable(),
                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('youtube_video_id')
                    ->label('ID YouTube')
                    ->searchable(),
                TextColumn::make('duracao')
                    ->label('Duração (s)')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('aprovado')
                    ->boolean(),
                IconColumn::make('ativo')
                    ->boolean(),
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
