<?php

namespace App\Filament\Admin\Resources\Noticias\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class NoticiaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('titulo'),
                TextEntry::make('slug'),
                TextEntry::make('resumo')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('conteudo')
                    ->columnSpanFull(),
                TextEntry::make('imagem')
                    ->placeholder('-'),
                IconEntry::make('destaque')
                    ->boolean(),
                IconEntry::make('ativo')
                    ->boolean(),
                TextEntry::make('publicado_em')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
