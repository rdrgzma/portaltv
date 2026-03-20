<?php

namespace App\Filament\Admin\Resources\Programacaos;

use App\Filament\Admin\Resources\Programacaos\Pages\CreateProgramacao;
use App\Filament\Admin\Resources\Programacaos\Pages\EditProgramacao;
use App\Filament\Admin\Resources\Programacaos\Pages\ListProgramacaos;
use App\Filament\Admin\Resources\Programacaos\Schemas\ProgramacaoForm;
use App\Filament\Admin\Resources\Programacaos\Tables\ProgramacaosTable;
use App\Models\Programacao;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProgramacaoResource extends Resource
{
    protected static ?string $model = Programacao::class;
    
    protected static ?string $navigationLabel = 'Programação';
            protected static string | UnitEnum | null $navigationGroup = 'WebTV';
       

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProgramacaoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramacaosTable::configure($table);
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
            'index' => ListProgramacaos::route('/'),
            'create' => CreateProgramacao::route('/create'),
            'edit' => EditProgramacao::route('/{record}/edit'),
        ];
    }
}