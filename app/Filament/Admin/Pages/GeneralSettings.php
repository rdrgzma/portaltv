<?php

namespace App\Filament\Admin\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Pages\Page;
use App\Models\Setting;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class GeneralSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.admin.pages.general-settings';
    protected static ?string $title = 'Configurações Gerais';
    protected static ?string $navigationLabel = 'Configurações';
    protected static string | \UnitEnum | null $navigationGroup = 'Configurações do Sistema';
    protected static ?int $navigationSort = 100;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-adjustments-horizontal';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'template_choice' => Setting::getValue('template_choice', 'classic'),
            'hero_type'       => Setting::getValue('hero_type', 'video'),
            'hero_video_url'  => Setting::getValue('hero_video_url', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'),
            'hero_image'      => Setting::getValue('hero_image'),
            'contact_whatsapp'=> Setting::getValue('contact_whatsapp', '(00) 00000-0000'),
            'contact_email'   => Setting::getValue('contact_email', 'contato@redenativossystem.com.br'),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Canais de Atendimento')
                    ->description('Configurações Globais de Contato')
                    ->schema([
                        TextInput::make('contact_whatsapp')
                            ->label('WhatsApp de Contato')
                            ->placeholder('(00) 00000-0000')
                            ->required(),
                        
                        TextInput::make('contact_email')
                            ->label('E-mail Oficial')
                            ->email()
                            ->placeholder('contato@exemplo.com')
                            ->required(),
                    ])->columns(2),

                Section::make('Identidade Visual')
                    ->schema([
                        Select::make('template_choice')
                            ->label('Template Principal')
                            ->options([
                                'classic' => 'Classic (Claro)',
                                'premium' => 'Premium (Dark Tech)',
                            ])
                            ->required(),
                    ]),

                Section::make('Hero do Site (Topo)')
                    ->description('Escolha o que aparece no topo do site (acima das notícias)')
                    ->schema([
                        Radio::make('hero_type')
                            ->label('Tipo de Conteúdo')
                            ->options([
                                'video' => 'Player de Vídeo (WebTV)',
                                'image' => 'Banner de Notícia em Destaque',
                            ])
                            ->live(),

                        TextInput::make('hero_video_url')
                            ->label('URL do Vídeo (YouTube)')
                            ->url()
                            ->visible(fn ($get) => $get('hero_type') === 'video'),

                        FileUpload::make('hero_image')
                            ->label('Imagem de Destaque')
                            ->image()
                            ->directory('settings')
                            ->visible(fn ($get) => $get('hero_type') === 'image'),
                    ]),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $settings = $this->form->getState();

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }

        Notification::make()
            ->title('Configurações salvas com sucesso!')
            ->success()
            ->send();
    }
}
