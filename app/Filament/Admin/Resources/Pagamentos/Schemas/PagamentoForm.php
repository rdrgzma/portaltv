<?php

namespace App\Filament\Admin\Resources\Pagamentos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PagamentoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('plano_id')
                    ->relationship('plano', 'nome')
                    ->required(),
                TextInput::make('valor')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pendente',
                        'completed' => 'Concluído',
                        'failed' => 'Falhou',
                    ])
                    ->required(),
                TextInput::make('gateway'),
                TextInput::make('transaction_id'),
                DatePicker::make('vencimento')
                    ->date('d/m/Y')
                    ->required(),
            ]);
    }
}
