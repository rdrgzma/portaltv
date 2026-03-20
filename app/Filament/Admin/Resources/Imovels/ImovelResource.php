<?php

namespace App\Filament\Admin\Resources\Imovels;

use App\Filament\Admin\Resources\Imovels\Pages\CreateImovel;
use App\Filament\Admin\Resources\Imovels\Pages\EditImovel;
use App\Filament\Admin\Resources\Imovels\Pages\ListImovels;
use App\Filament\Admin\Resources\Imovels\Pages\ViewImovel;
use App\Filament\Admin\Resources\Imovels\Schemas\ImovelForm;
use App\Filament\Admin\Resources\Imovels\Schemas\ImovelInfolist;
use App\Filament\Admin\Resources\Imovels\Tables\ImovelsTable;
use App\Models\Imovel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ImovelResource extends Resource
{
    protected static ?string $model = Imovel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Imóveis';
    protected static ?string $navigationLabel = 'Imóveis';

    protected static ?string $recordTitleAttribute = 'titulo';

    public static function form(Schema $schema): Schema
    {
        return ImovelForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ImovelInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ImovelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListImovels::route('/'),
            'create' => CreateImovel::route('/create'),
          
            'edit' => EditImovel::route('/{record}/edit'),
        ];
    }
}
