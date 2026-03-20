<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use willvincent\Feeds\Facades\FeedsFacade as Feeds;

class RegionalNewsService
{
    protected array $feeds = [
        'br' => 'https://g1.globo.com/dynamo/brasil/rss2.xml',
        'rs' => 'https://g1.globo.com/dynamo/rs/rio-grande-do-sul/rss2.xml',
        'sc' => 'https://g1.globo.com/dynamo/sc/santa-catarina/rss2.xml',
        'pr' => 'https://g1.globo.com/dynamo/pr/parana/rss2.xml',
        'sp' => 'https://g1.globo.com/dynamo/sao-paulo/rss2.xml',
        'rj' => 'https://g1.globo.com/dynamo/rio-de-janeiro/rss2.xml',
        'mg' => 'https://g1.globo.com/dynamo/minas-gerais/rss2.xml',
        'es' => 'https://g1.globo.com/dynamo/es/espirito-santo/rss2.xml',
        'ba' => 'https://g1.globo.com/dynamo/bahia/rss2.xml',
        'pe' => 'https://g1.globo.com/dynamo/pe/recife-regiao/rss2.xml',
        'ce' => 'https://g1.globo.com/dynamo/ceara/rss2.xml',
        'am' => 'https://g1.globo.com/dynamo/am/amazonas/rss2.xml',
        'pa' => 'https://g1.globo.com/dynamo/pa/para/rss2.xml',
        'go' => 'https://g1.globo.com/dynamo/goias/rss2.xml',
        'df' => 'https://g1.globo.com/dynamo/distrito-federal/rss2.xml',
        'rn' => 'https://g1.globo.com/dynamo/rn/rio-grande-do-norte/rss2.xml',
        'pb' => 'https://g1.globo.com/dynamo/pb/paraiba/rss2.xml',
        'ma' => 'https://g1.globo.com/dynamo/ma/maranhao/rss2.xml',
        'pi' => 'https://g1.globo.com/dynamo/pi/piaui/rss2.xml',
        'ro' => 'https://g1.globo.com/dynamo/ro/rondonia/rss2.xml',
        'ac' => 'https://g1.globo.com/dynamo/ac/acre/rss2.xml',
        'ap' => 'https://g1.globo.com/dynamo/ap/amapa/rss2.xml',
        'rr' => 'https://g1.globo.com/dynamo/rr/roraima/rss2.xml',
        'ms' => 'https://g1.globo.com/dynamo/ms/mato-grosso-do-sul/rss2.xml',
        'mt' => 'https://g1.globo.com/dynamo/mt/mato-grosso/rss2.xml',
        'to' => 'https://g1.globo.com/dynamo/to/tocantins/rss2.xml',
    ];

    public function getStates(): array
    {
        return [
            'br' => 'Brasil',
            'rs' => 'Rio Grande do Sul',
            'sc' => 'Santa Catarina',
            'pr' => 'Paraná',
            'sp' => 'São Paulo',
            'rj' => 'Rio de Janeiro',
            'mg' => 'Minas Gerais',
            'es' => 'Espírito Santo',
            'ba' => 'Bahia',
            'pe' => 'Pernambuco',
            'ce' => 'Ceará',
            'am' => 'Amazonas',
            'pa' => 'Pará',
            'go' => 'Goiás',
            'df' => 'Distrito Federal',
            'rn' => 'Rio Grande do Norte',
            'pb' => 'Paraíba',
            'ma' => 'Maranhão',
            'pi' => 'Piauí',
            'ro' => 'Rondônia',
            'ac' => 'Acre',
            'ap' => 'Amapá',
            'rr' => 'Roraima',
            'ms' => 'Mato Grosso do Sul',
            'mt' => 'Mato Grosso',
            'to' => 'Tocantins',
        ];
    }

    public function getNews(string $state, int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        $url   = $this->feeds[$state] ?? $this->feeds['rs'];
        $feed  = Feeds::make($url);
        $items = collect();
        $today = Carbon::today()->format('Y-m-d');

        foreach ($feed->get_items() as $item) {
            $pubDate = Carbon::parse($item->get_date())->format('Y-m-d');

            if ($pubDate !== $today) {
                continue;
            }

            $description = $item->get_description() ?? '';
            $fullContent = $item->get_content() ?? $description;
            $image       = $this->extractImage($description) ?? $this->extractImage($fullContent);

            // Source / Author
            $source = null;
            if ($itemSource = $item->get_source()) {
                $source = $itemSource->get_title();
            }
            if (! $source) {
                $source = $feed->get_title();
            }

            $items->push([
                'id'          => md5($item->get_permalink()),
                'title'       => $item->get_title(),
                'link'        => $item->get_permalink(),
                'description' => strip_tags($description),
                'full_content'=> strip_tags($fullContent),
                'date'        => Carbon::parse($item->get_date())->format('d/m/Y H:i'),
                'date_raw'    => $item->get_date(),
                'image'       => $image,
                'source'      => $source ?? 'G1',
                'author'      => $item->get_author()?->get_name(),
                'state'       => $state,
            ]);
        }

        return $this->paginateCollection($items, $perPage, $page);
    }

    /**
     * Busca um item específico pelo hash do link, dentro do feed do estado.
     */
    public function getNewsItem(string $state, string $id): ?array
    {
        $url  = $this->feeds[$state] ?? $this->feeds['rs'];
        $feed = Feeds::make($url);

        foreach ($feed->get_items() as $item) {
            if (md5($item->get_permalink()) === $id) {
                $description = $item->get_description() ?? '';
                $fullContent = $item->get_content() ?? $description;
                $image       = $this->extractImage($description) ?? $this->extractImage($fullContent);

                $source = null;
                if ($itemSource = $item->get_source()) {
                    $source = $itemSource->get_title();
                }
                if (! $source) {
                    $source = $feed->get_title();
                }

                return [
                    'id'           => md5($item->get_permalink()),
                    'title'        => $item->get_title(),
                    'link'         => $item->get_permalink(),
                    'description'  => strip_tags($description),
                    'full_content' => strip_tags($fullContent),
                    'date'         => Carbon::parse($item->get_date())->format('d/m/Y \à\s H:i'),
                    'image'        => $image,
                    'source'       => $source ?? 'G1',
                    'author'       => $item->get_author()?->get_name(),
                    'state'        => $state,
                    'state_name'   => $this->getStates()[$state] ?? strtoupper($state),
                ];
            }
        }

        return null;
    }

    /**
     * Apaga os arquivos de cache do SimplePie para o feed do estado.
     */
    public function clearCache(string $state): void
    {
        $cacheDir = config('feeds.cache.location', storage_path('framework/cache'));
        $url      = $this->feeds[$state] ?? $this->feeds['rs'];

        // SimplePie nomeia os arquivos de cache com MD5 da URL
        $prefix = md5($url);

        if (! File::isDirectory($cacheDir)) {
            return;
        }

        foreach (File::files($cacheDir) as $file) {
            if (str_starts_with($file->getFilename(), $prefix)) {
                File::delete($file->getPathname());
            }
        }
    }

    protected function extractImage(string $content): ?string
    {
        preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches);
        return $matches[1] ?? null;
    }

    protected function paginateCollection(Collection $items, int $perPage, int $page): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}
