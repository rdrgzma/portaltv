<?php

namespace App\Filament\Admin\Resources\Anuncios;

use App\Filament\Admin\Resources\Anuncios\Pages\CreateAnuncio;
use App\Filament\Admin\Resources\Anuncios\Pages\EditAnuncio;
use App\Filament\Admin\Resources\Anuncios\Pages\ListAnuncios;
use App\Filament\Admin\Resources\Anuncios\Schemas\AnuncioForm;
use App\Filament\Admin\Resources\Anuncios\Tables\AnunciosTable;
use App\Models\Anuncio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AnuncioResource extends Resource
{
    protected static ?string $model = Anuncio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
     protected static string | UnitEnum | null $navigationGroup = 'Anúncios';
     protected static ?string $navigationLabel = 'Anúncios';

    public static function getMaxContentWidth(): string
    {
        return 'full';
    }

    protected static ?string $recordTitleAttribute = 'anunciante_id';

    public static function form(Schema $schema): Schema
    {
        return AnuncioForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnunciosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAnuncios::route('/'),
            'create' => CreateAnuncio::route('/create'),
            'edit' => EditAnuncio::route('/{record}/edit'),
        ];
    }
}
