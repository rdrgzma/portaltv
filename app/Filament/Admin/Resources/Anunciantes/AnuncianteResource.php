<?php

namespace App\Filament\Admin\Resources\Anunciantes;

use App\Filament\Admin\Resources\Anunciantes\Pages\CreateAnunciante;
use App\Filament\Admin\Resources\Anunciantes\Pages\EditAnunciante;
use App\Filament\Admin\Resources\Anunciantes\Pages\ListAnunciantes;
use App\Filament\Admin\Resources\Anunciantes\Schemas\AnuncianteForm;
use App\Filament\Admin\Resources\Anunciantes\Tables\AnunciantesTable;
use App\Models\Anunciante;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
 use UnitEnum;

class AnuncianteResource extends Resource
{
    protected static ?string $model = Anunciante::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
   

protected static string | UnitEnum | null $navigationGroup = 'Anúncios';
    

    protected static ?string $recordTitleAttribute = 'nome';

    public static function form(Schema $schema): Schema
    {
        return AnuncianteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnunciantesTable::configure($table);
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
            'index' => ListAnunciantes::route('/'),
            'create' => CreateAnunciante::route('/create'),
            'edit' => EditAnunciante::route('/{record}/edit'),
        ];
    }
}
