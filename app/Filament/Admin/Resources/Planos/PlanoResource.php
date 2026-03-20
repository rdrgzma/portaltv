<?php

namespace App\Filament\Admin\Resources\Planos;

use App\Filament\Admin\Resources\Planos\Pages\CreatePlano;
use App\Filament\Admin\Resources\Planos\Pages\EditPlano;
use App\Filament\Admin\Resources\Planos\Pages\ListPlanos;
use App\Filament\Admin\Resources\Planos\Schemas\PlanoForm;
use App\Filament\Admin\Resources\Planos\Tables\PlanosTable;
use App\Models\Plano;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PlanoResource extends Resource
{
    protected static ?string $model = Plano::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
        protected static ?string $navigationLabel = 'Planos';
    protected static string | UnitEnum | null $navigationGroup = 'Gestão';

    protected static ?string $recordTitleAttribute = 'nome';

    public static function form(Schema $schema): Schema
    {
        return PlanoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlanosTable::configure($table);
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
            'index' => ListPlanos::route('/'),
            'create' => CreatePlano::route('/create'),
            'edit' => EditPlano::route('/{record}/edit'),
        ];
    }
}
