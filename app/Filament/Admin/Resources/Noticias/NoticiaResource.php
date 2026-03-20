<?php

namespace App\Filament\Admin\Resources\Noticias;

use App\Filament\Admin\Resources\Noticias\Pages\CreateNoticia;
use App\Filament\Admin\Resources\Noticias\Pages\EditNoticia;
use App\Filament\Admin\Resources\Noticias\Pages\ListNoticias;
use App\Filament\Admin\Resources\Noticias\Pages\ViewNoticia;
use App\Filament\Admin\Resources\Noticias\Schemas\NoticiaForm;
use App\Filament\Admin\Resources\Noticias\Schemas\NoticiaInfolist;
use App\Filament\Admin\Resources\Noticias\Tables\NoticiasTable;
use App\Models\Noticia;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class NoticiaResource extends Resource
{
    protected static ?string $model = Noticia::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
        protected static string | UnitEnum | null $navigationGroup = 'Notícias';
        protected static ?string $navigationLabel = 'Notícias';

    protected static ?string $recordTitleAttribute = 'titulo';

    public static function form(Schema $schema): Schema
    {
        return NoticiaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return NoticiaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NoticiasTable::configure($table);
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
            'index' => ListNoticias::route('/'),
            'create' => CreateNoticia::route('/create'),
            'view' => ViewNoticia::route('/{record}'),
            'edit' => EditNoticia::route('/{record}/edit'),
        ];
    }
}
