<?php

namespace App\Filament\Admin\Pages;

use App\Models\RegionalNewsItem;
use App\Services\RegionalNewsService;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use UnitEnum;

class RegionalNews extends Page
{
    use WithPagination;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map';
    protected string $view = 'filament.pages.regional-news';
    protected static ?string $title = 'Notícias por Região';
    protected static ?string $navigationLabel = 'Notícias por Região';
    protected static string | UnitEnum | null $navigationGroup = 'Notícias';
    public string $state = 'ba';

    public function mount(): void
    {
        $this->form->fill(['state' => $this->state]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('state')
                    ->label('Selecione o Estado/Região')
                    ->options(app(RegionalNewsService::class)->getStates())
                    ->default('br')
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function (?string $state) {
                        $this->state = $state ?? 'br';
                        $this->resetPage();
                    }),
            ]);
    }

    /**
     * Força a atualização limpando o cache do feed atual.
     */
    public function refreshNews(): void
    {
        app(RegionalNewsService::class)->clearCache($this->state);

        $stateName = app(RegionalNewsService::class)->getStates()[$this->state] ?? strtoupper($this->state);

        Notification::make()
            ->title("Notícias de {$stateName} atualizadas!")
            ->body('O cache foi limpo. As notícias mais recentes serão carregadas.')
            ->success()
            ->duration(4000)
            ->send();
    }

    /**
     * Alterna o flag "destaque" de uma notícia.
     */
    public function toggleDestaque(string $rssId, string $state): void
    {
        $item = $this->syncItem($rssId, $state);
        $item->update(['destaque' => ! $item->destaque]);

        Notification::make()
            ->title($item->destaque ? '⭐ Notícia destacada!' : 'Destaque removido')
            ->success()
            ->duration(2500)
            ->send();
    }

    /**
     * Alterna o flag "publicado" de uma notícia.
     */
    public function togglePublicado(string $rssId, string $state): void
    {
        $item = $this->syncItem($rssId, $state);
        $item->update(['publicado' => ! $item->publicado]);

        Notification::make()
            ->title($item->publicado ? '✅ Publicada no site!' : 'Notícia despublicada')
            ->success()
            ->duration(2500)
            ->send();
    }

    /**
     * Garante que a notícia existe no banco (faz upsert se necessário).
     */
    protected function syncItem(string $rssId, string $state): RegionalNewsItem
    {
        $existing = RegionalNewsItem::where('rss_id', $rssId)->first();

        if ($existing) {
            return $existing;
        }

        // Se ainda não existe no banco, busca no RSS e salva
        $data = app(RegionalNewsService::class)->getNewsItem($state, $rssId);

        abort_if(is_null($data), 404);

        return RegionalNewsItem::syncFromRss($data);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('refresh')
                ->label('Atualizar Notícias')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->action('refreshNews'),
        ];
    }

    public function getNews(): LengthAwarePaginator
    {
        return app(RegionalNewsService::class)->getNews(
            $this->state,
            10,
            $this->paginators['page'] ?? 1
        );
    }

    /**
     * Retorna o mapa rssId => RegionalNewsItem para os itens da página atual.
     */
    public function getSavedItems(LengthAwarePaginator $news): array
    {
        $ids = collect($news->items())->pluck('id')->all();

        return RegionalNewsItem::whereIn('rss_id', $ids)
            ->get()
            ->keyBy('rss_id')
            ->all();
    }

    protected function getViewData(): array
    {
        $news  = $this->getNews();
        $saved = $this->getSavedItems($news);

        return [
            'news'  => $news,
            'saved' => $saved,
        ];
    }
}
