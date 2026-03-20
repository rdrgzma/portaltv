<?php

namespace App\Filament\Admin\Resources\Imovels\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ImovelInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('titulo'),
                TextEntry::make('slug'),
                TextEntry::make('descricao')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('tipo')
                    ->placeholder('-'),
                TextEntry::make('valor')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('quartos')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('banheiros')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('garagem')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('area')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('localizacao')
                    ->placeholder('-'),
                TextEntry::make('youtube_url')
                    ->placeholder('-'),
                IconEntry::make('destaque')
                    ->boolean(),
                IconEntry::make('ativo')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
