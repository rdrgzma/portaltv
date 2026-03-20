<?php

namespace App\Filament\Admin\Resources\Imovels\RelationManagers;

use App\Filament\Admin\Resources\Imovels\ImovelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Schemas\Schema;

class ImagensRelationManager extends RelationManager
{
    protected static string $relationship = 'imagens';

    protected static ?string $relatedResource = ImovelResource::class;

    public function form(Schema $schema): Schema
{
    return $schema
        ->components([
            Forms\Components\TextInput::make('imovel_id')->required(),
            Forms\Components\FileUpload::make('imagem')
                ->disk('public')
                ->image()
                ->imageEditor()
                ->required(),
            Forms\Components\TextInput::make('ordem')->numeric()->required()->default(1),
            
        ]);
}

   
}
