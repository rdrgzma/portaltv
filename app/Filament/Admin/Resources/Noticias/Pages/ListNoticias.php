<?php

namespace App\Filament\Admin\Resources\Noticias\Pages;

use App\Filament\Admin\Resources\Noticias\NoticiaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Services\Noticias\G1ImportService; // Seu serviço de Crawler
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;

class ListNoticias extends ListRecords
{
    protected static string $resource = NoticiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Actions\Action::make('importarG1')
            ->label('Importar do G1')
            ->icon('heroicon-o-cloud-arrow-down')
            ->form([
                Forms\Components\Select::make('rss_url')
                    ->label('Fonte do G1')
                    ->searchable()
                    ->required()
                    ->options([
                        'Principais e Editorias' => [
                            'https://g1.globo.com/dynamo/rss2.xml' => 'G1 - Todas as Notícias',
                            'https://g1.globo.com/dynamo/brasil/rss2.xml' => 'Brasil',
                            'https://g1.globo.com/dynamo/politica/mensalao/rss2.xml' => 'Política',
                            'https://g1.globo.com/dynamo/economia/rss2.xml' => 'Economia',
                            'https://g1.globo.com/dynamo/tecnologia/rss2.xml' => 'Tecnologia e Games',
                            'https://g1.globo.com/dynamo/ciencia-e-saude/rss2.xml' => 'Ciência e Saúde',
                            'https://g1.globo.com/dynamo/carros/rss2.xml' => 'Carros (AutoEsporte)',
                            'https://g1.globo.com/dynamo/mundo/rss2.xml' => 'Mundo',
                            'https://g1.globo.com/dynamo/educacao/rss2.xml' => 'Educação',
                            'https://g1.globo.com/dynamo/musica/rss2.xml' => 'Música',
                            'https://g1.globo.com/dynamo/pop-arte/rss2.xml' => 'Pop & Arte',
                            'https://g1.globo.com/dynamo/natureza/rss2.xml' => 'Natureza',
                            'https://g1.globo.com/dynamo/turismo-e-viagem/rss2.xml' => 'Turismo e Viagem',
                            'https://g1.globo.com/dynamo/concursos-e-emprego/rss2.xml' => 'Concursos e Emprego',
                            'https://g1.globo.com/dynamo/planeta-bizarro/rss2.xml' => 'Planeta Bizarro',
                            'https://g1.globo.com/dynamo/loterias/rss2.xml' => 'Loterias',
                        ],
                        'São Paulo' => [
                            'https://g1.globo.com/dynamo/sao-paulo/rss2.xml' => 'SP - São Paulo (Capital)',
                            'https://g1.globo.com/dynamo/sp/bauru-marilia/rss2.xml' => 'SP - Bauru e Marília',
                            'https://g1.globo.com/dynamo/sp/campinas-regiao/rss2.xml' => 'SP - Campinas e Região',
                            'https://g1.globo.com/dynamo/sao-paulo/itapetininga-regiao/rss2.xml' => 'SP - Itapetininga e Região',
                            'https://g1.globo.com/dynamo/sp/mogi-das-cruzes-suzano/rss2.xml' => 'SP - Mogi das Cruzes e Suzano',
                            'https://g1.globo.com/dynamo/sp/piracicaba-regiao/rss2.xml' => 'SP - Piracicaba e Região',
                            'https://g1.globo.com/dynamo/sp/presidente-prudente-regiao/rss2.xml' => 'SP - Prudente e Região',
                            'https://g1.globo.com/dynamo/sp/ribeirao-preto-franca/rss2.xml' => 'SP - Ribeirão Preto e Franca',
                            'https://g1.globo.com/dynamo/sao-paulo/sao-jose-do-rio-preto-aracatuba/rss2.xml' => 'SP - Rio Preto e Araçatuba',
                            'https://g1.globo.com/dynamo/sp/santos-regiao/rss2.xml' => 'SP - Santos e Região',
                            'https://g1.globo.com/dynamo/sp/sao-carlos-regiao/rss2.xml' => 'SP - São Carlos e Araraquara',
                            'https://g1.globo.com/dynamo/sao-paulo/sorocaba-jundiai/rss2.xml' => 'SP - Sorocaba e Jundiaí',
                            'https://g1.globo.com/dynamo/sp/vale-do-paraiba-regiao/rss2.xml' => 'SP - Vale do Paraíba',
                        ],
                        'Rio de Janeiro' => [
                            'https://g1.globo.com/dynamo/rio-de-janeiro/rss2.xml' => 'RJ - Rio de Janeiro (Capital)',
                            'https://g1.globo.com/dynamo/rj/regiao-serrana/rss2.xml' => 'RJ - Região Serrana',
                            'https://g1.globo.com/dynamo/rj/regiao-dos-lagos/rss2.xml' => 'RJ - Região dos Lagos',
                            'https://g1.globo.com/dynamo/rj/norte-fluminense/rss2.xml' => 'RJ - Norte Fluminense',
                            'https://g1.globo.com/dynamo/rj/sul-do-rio-costa-verde/rss2.xml' => 'RJ - Sul e Costa Verde',
                        ],
                        'Minas Gerais' => [
                            'https://g1.globo.com/dynamo/minas-gerais/rss2.xml' => 'MG - Minas Gerais (Geral)',
                            'https://g1.globo.com/dynamo/mg/centro-oeste/rss2.xml' => 'MG - Centro-Oeste',
                            'https://g1.globo.com/dynamo/mg/grande-minas/rss2.xml' => 'MG - Grande Minas',
                            'https://g1.globo.com/dynamo/mg/sul-de-minas/rss2.xml' => 'MG - Sul de Minas',
                            'https://g1.globo.com/dynamo/minas-gerais/triangulo-mineiro/rss2.xml' => 'MG - Triângulo Mineiro',
                            'https://g1.globo.com/dynamo/mg/vales-mg/rss2.xml' => 'MG - Vales de Minas',
                            'https://g1.globo.com/dynamo/mg/zona-da-mata/rss2.xml' => 'MG - Zona da Mata',
                        ],
                        'Sul' => [
                            'https://g1.globo.com/dynamo/pr/parana/rss2.xml' => 'PR - Paraná (Geral)',
                            'https://g1.globo.com/dynamo/pr/campos-gerais-sul/rss2.xml' => 'PR - Campos Gerais e Sul',
                            'https://g1.globo.com/dynamo/pr/oeste-sudoeste/rss2.xml' => 'PR - Oeste e Sudoeste',
                            'https://g1.globo.com/dynamo/pr/norte-noroeste/rss2.xml' => 'PR - Norte e Noroeste',
                            'https://g1.globo.com/dynamo/rs/rio-grande-do-sul/rss2.xml' => 'RS - Rio Grande do Sul',
                            'https://g1.globo.com/dynamo/sc/santa-catarina/rss2.xml' => 'SC - Santa Catarina',
                        ],
                        'Nordeste' => [
                            'https://g1.globo.com/dynamo/al/alagoas/rss2.xml' => 'AL - Alagoas',
                            'https://g1.globo.com/dynamo/bahia/rss2.xml' => 'BA - Bahia',
                            'https://g1.globo.com/dynamo/ceara/rss2.xml' => 'CE - Ceará',
                            'https://g1.globo.com/dynamo/ma/maranhao/rss2.xml' => 'MA - Maranhão',
                            'https://g1.globo.com/dynamo/pb/paraiba/rss2.xml' => 'PB - Paraíba',
                            'https://g1.globo.com/dynamo/pernambuco/rss2.xml' => 'PE - Pernambuco',
                            'https://g1.globo.com/dynamo/pe/caruaru-regiao/rss2.xml' => 'PE - Caruaru e Região',
                            'https://g1.globo.com/dynamo/pe/petrolina-regiao/rss2.xml' => 'PE - Petrolina e Região',
                            'https://g1.globo.com/dynamo/rn/rio-grande-do-norte/rss2.xml' => 'RN - Rio Grande do Norte',
                            'https://g1.globo.com/dynamo/se/sergipe/rss2.xml' => 'SE - Sergipe',
                        ],
                        'Norte' => [
                            'https://g1.globo.com/dynamo/ac/acre/rss2.xml' => 'AC - Acre',
                            'https://g1.globo.com/dynamo/ap/amapa/rss2.xml' => 'AP - Amapá',
                            'https://g1.globo.com/dynamo/am/amazonas/rss2.xml' => 'AM - Amazonas',
                            'https://g1.globo.com/dynamo/pa/para/rss2.xml' => 'PA - Pará',
                            'https://g1.globo.com/dynamo/ro/rondonia/rss2.xml' => 'RO - Rondônia',
                            'https://g1.globo.com/dynamo/rr/roraima/rss2.xml' => 'RR - Roraima',
                            'https://g1.globo.com/dynamo/to/tocantins/rss2.xml' => 'TO - Tocantins',
                        ],
                        'Centro-Oeste' => [
                            'https://g1.globo.com/dynamo/distrito-federal/rss2.xml' => 'DF - Distrito Federal',
                            'https://g1.globo.com/dynamo/goias/rss2.xml' => 'GO - Goiás',
                            'https://g1.globo.com/dynamo/mato-grosso/rss2.xml' => 'MT - Mato Grosso',
                            'https://g1.globo.com/dynamo/mato-grosso-do-sul/rss2.xml' => 'MS - Mato Grosso do Sul',
                        ],
                    ])
                    ->required(),
            Forms\Components\Select::make('categoria_destino')
                ->label('Salvar na Categoria do Portal')
                ->placeholder('Selecione para onde a notícia vai...')
                ->required()
                ->native(false) // Deixa o select com o visual moderno do Filament
                ->options([
                    'politica'       => 'Política',
                    'esportes'       => 'Esportes',
                    'entretenimento' => 'Entretenimento',
                    'tecnologia'     => 'Tecnologia',
                    'saude'          => 'Saúde',
                    'negocios'       => 'Negócios',
                    'curiosidades'   => 'Curiosidades',
                    'geral'          => 'Geral',
                ])
                    ->required(),
            ])
            ->action(function (array $data, G1ImportService $service) {
              //  set_time_limit(300)
                $service->importar($data['rss_url'], $data['categoria_destino']);
                Notification::make()->title('Notícias importadas com sucesso!')->success()->send();
            }),
                // Novo Botão de Limpeza
            Actions\Action::make('limparNoticiasAntigas')
                ->label('Limpar Notícias Antigas')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Apagar registros antigos?')
                ->modalDescription('Isso removerá permanentemente todas as notícias com mais de 30 dias.')
                ->action(function () {
                    $quantidade = \App\Models\Noticia::where('created_at', '<', now()->subDays(30))->delete();
    
                    Notification::make()
                        ->title("Limpeza concluída!")
                        ->body("{$quantidade} notícias antigas foram removidas.")
                        ->success()
                        ->send();
                }),
    
        ];
    }
}
