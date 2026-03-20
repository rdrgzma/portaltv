<?php

namespace App\Filament\Admin\Pages;

use App\Services\RegionalNewsService;
use Filament\Pages\Page;

class RegionalNewsShow extends Page
{
    protected static bool $shouldRegisterNavigation = false;
    protected string $view = 'filament.pages.regional-news-show';
    protected static ?string $title = 'Detalhes da Notícia';

    public string $state = 'rs';
    public string $id    = '';

    public function mount(): void
    {
        $this->state = request()->query('state', 'rs');
        $this->id    = request()->query('id', '');

        abort_if(empty($this->id), 404);
    }

    public static function getDetailUrl(string $state, string $id): string
    {
        return url('/admin/regional-news-show') . '?' . http_build_query([
            'state' => $state,
            'id'    => $id,
        ]);
    }

    protected function getViewData(): array
    {
        $article = app(RegionalNewsService::class)->getNewsItem($this->state, $this->id);

        abort_if(is_null($article), 404);

        return ['article' => $article];
    }
}
