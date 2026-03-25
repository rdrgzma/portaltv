<?php

namespace App\Filament\Admin\Resources\Anuncios\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class AnuncioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Grid::make(12)->schema([
                    
                    // ─── ESQUERDA: Configurações (4-span) ───────────────────────
                    Grid::make(1)->schema([
                        Section::make('⚙️ Configurações')
                            ->schema([
                                Select::make('anunciante_id')
                                    ->label('💼 Anunciante')
                                    ->relationship('anunciante', 'nome')
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                Select::make('tipo')
                                    ->label('📍 Posição do Banner')
                                    ->options([
                                        'banner_horizontal'       => 'Inferior Horizontal',
                                        'banner_lateral_direita'  => 'Lateral Direita (Vertical)',
                                        'banner_lateral_esquerda' => 'Lateral Esquerda (Vertical)',
                                    ])
                                    ->required(),
                            ]),

                        Section::make('📅 Agendamento & Status')
                            ->schema([
                                Grid::make(1)->schema([
                                    DatePicker::make('inicio')
                                        ->label('Início')
                                        ->required()
                                        ->native(false)
                                        ->displayFormat('d/m/Y'),

                                    DatePicker::make('fim')
                                        ->label('Fim')
                                        ->required()
                                        ->native(false)
                                        ->displayFormat('d/m/Y'),
                                ]),

                                TextInput::make('prioridade')
                                    ->label('🔝 Prioridade')
                                    ->numeric()
                                    ->default(0),

                                Toggle::make('ativo')
                                    ->label('Anúncio Ativo')
                                    ->default(true)
                                    ->inline(false),
                            ]),
                    ])->columnSpan(4),

                    // ─── DIREITA: Conteúdo (8-span) ─────────────────────────────
                    Grid::make(1)->schema([
                        Section::make('📺 Conteúdo Exibido')
                            ->description('Gerencie a mídia e o link de destino do anúncio.')
                            ->schema([
                                
                                Radio::make('exibir_midia')
                                    ->label('Escolha o que exibir:')
                                    ->options([
                                        'arquivo' => '🖼️ Arquivo Enviado',
                                        'youtube' => '▶️ Link do YouTube',
                                    ])
                                    ->default('arquivo')
                                    ->required()
                                    ->live()
                                    ->inline()
                                    ->extraAttributes(['class' => 'bg-slate-50 dark:bg-white/5 p-4 rounded-xl border border-slate-200 dark:border-white/10 mb-4']),

                                // Container para Mídia (Upload ou YouTube)
                                Grid::make(1)->schema([
                                    FileUpload::make('arquivo')
                                        ->label('Upload de Mídia (Imagem ou Vídeo)')
                                        ->helperText('Máximo 20MB. Recomendado: MP4 ou JPG/WebP.')
                                        ->disk('public')
                                        ->directory('anuncios')
                                        ->visibility('public')
                                        ->acceptedFileTypes(['image/*', 'video/mp4', 'video/webm', 'video/ogg'])
                                        ->previewable(false) // <--- DESATIVA A PRÉVIA (Evita que o FilePond tente baixar o arquivo atual)
                                        ->fetchFileInformation(false) // <--- Não busca metadados
                                        ->deletable()
                                        ->openable(false) // <--- Não permite abrir/carregar o arquivo atual
                                        ->visible(fn (Get $get) => $get('exibir_midia') === 'arquivo')
                                        ->required(fn (Get $get) => $get('exibir_midia') === 'arquivo'),

                                    TextInput::make('youtube_url')
                                        ->label('Link do Vídeo no YouTube')
                                        ->placeholder('Ex: https://www.youtube.com/watch?v=...')
                                        ->url()
                                        ->visible(fn (Get $get) => $get('exibir_midia') === 'youtube')
                                        ->required(fn (Get $get) => $get('exibir_midia') === 'youtube'),
                                ]),

                                TextInput::make('link')
                                    ->label('🔗 Link de Destino (Clique)')
                                    ->placeholder('https://...')
                                    ->url()
                                    ->helperText('Para onde o visitante será levado ao clicar no banner.')
                                    ->extraAttributes(['class' => 'mt-6']),
                            ]),
                    ])->columnSpan(8),
                ]),
            ]);
    }
}
