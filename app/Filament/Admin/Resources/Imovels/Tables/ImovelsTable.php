<?php

namespace App\Filament\Admin\Resources\Imovels\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class ImovelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('tipo')
                    ->searchable(),
                TextColumn::make('valor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quartos')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('banheiros')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('garagem')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('area')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('localizacao')
                    ->searchable(),
                TextColumn::make('youtube_url')
                    ->searchable(),
                IconColumn::make('destaque')
                    ->boolean(),
                IconColumn::make('ativo')
                    ->boolean(),
                   
               
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
