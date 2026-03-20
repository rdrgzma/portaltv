<?php

namespace App\Filament\Admin\Resources\Anuncios\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class AnunciosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('anunciante.nome')
                    ->searchable(),
                TextColumn::make('tipo')
                    ->searchable(),
                TextColumn::make('link')
                    ->searchable(),
                TextColumn::make('inicio')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('fim')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('prioridade')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('ativo')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y ')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
