<?php

use App\Domains\CategoriesTranslation\Models\CategoriesTranslationModel;
use App\Domains\Redirect\Models\RedirectModel;
use App\Domains\SubcategoriesTranslation\Models\SubcategoriesTranslationModel;
use BaseCms\BaseBlockBuilder\Models\BlockModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('categories_translations', function (Blueprint $table) {
            $table->string('hero_title')->nullable()->change();
        });

        $categoriesTranslations = CategoriesTranslationModel::all();

        foreach ($categoriesTranslations as $categoriesTranslation) {
            $categoriesTranslation->hero_title = html_entity_decode(strip_tags($categoriesTranslation->hero_title), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $categoriesTranslation->save();
        }

        Schema::table('subcategories_translations', function (Blueprint $table) {
            $table->string('hero_title')->nullable()->change();
        });

        $subcategoriesTranslations = SubcategoriesTranslationModel::all();

        foreach ($subcategoriesTranslations as $subcategoriesTranslation) {
            $subcategoriesTranslation->hero_title = html_entity_decode(strip_tags($subcategoriesTranslation->hero_title), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $subcategoriesTranslation->save();
        }

        $blocks = BlockModel::query()
            ->where('componentClass', 'App\View\Components\Frontend\Block\Hero')
            ->orWhere('componentClass', 'App\View\Components\Frontend\Block\ThinHero')
            ->get();

        foreach ($blocks as $block) {
            $block->params = array_merge(json_decode($block->getRawOriginal('params'), true), [
                'title' => html_entity_decode(strip_tags(json_decode($block->getRawOriginal('params'), true)['title']), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
            ]);
            $block->save();
        }

        $redirects = [
            ['slug_from' => 'blog/2016/06/08/a-stara-recebe-a-visita-de-richard-b-ferguson-especialista-em-agricultura-de-precisao', 'slug_to' => 'noticias/feiras-e-eventos/a-stara-recebe-a-visita-de-richard-b-ferguson-especialista-em-agricultura-de-precisao'],
            ['slug_from' => 'blog/2016/07/25/palmeira-das-missoes-rs-recebe-o-dia-fantastico', 'slug_to' => 'noticias/noticias/palmeira-das-missoes-rs-recebe-o-dia-fantastico'],
            ['slug_from' => 'blog/produto/hercules-6-0', 'slug_to' => 'produtos-servicos/maquinas-agricolas/distribuidores/hercules-60'],
            ['slug_from' => 'catalogo/tornado-600-md', 'slug_to' => 'produtos-servicos/maquinas-agricolas'],
            ['slug_from' => 'concessionaria-agriterra-realiza-treinamento-em-tapurah-mt', 'slug_to' => 'noticias/noticias/concessionaria-agriterra-realiza-treinamento-em-tapurah-mt'],
            ['slug_from' => 'en/products-services/agricultural-machines/spreaders/bruttus-12000', 'slug_to' => 'en/products-services/agricultural-machines/spreaders/bruttus-25000-18000-and-12000'],
            ['slug_from' => 'en/products-services/agricultural-machines/spreaders/hercules-15000-and-10000-inox', 'slug_to' => 'en/products-services/agricultural-machines/spreaders/hercules-24000-15000-and-10000-inox'],
            ['slug_from' => 'en/products-services/agricultural-machines/spreaders/hercules-15000-y-10000-inox', 'slug_to' => 'en/products-services/agricultural-machines/spreaders/hercules-24000-15000-and-10000-inox'],
            ['slug_from' => 'en/products-services/agricultural-machines/spreaders/hercules-6_0', 'slug_to' => 'en/products-services/agricultural-machines/spreaders/hercules-60'],
            ['slug_from' => 'en/produto/imperador-3-/How', 'slug_to' => 'en/products-services/agricultural-machines/sprayers/imperador-30'],
            ['slug_from' => 'en/produto/imperador-3-0', 'slug_to' => 'en/products-services/agricultural-machines/sprayers/imperador-30'],
            ['slug_from' => 'es/contactanos/marketing', 'slug_to' => 'es/contactanos/outros'],
            ['slug_from' => 'es/contactanos/representante', 'slug_to' => 'es/contactanos/outros'],
            ['slug_from' => 'es/noticias-es/concesionarias/concesionaria-dinamica-hace-la-entrega-de-estrela-en-nova-mutum-mt', 'slug_to' => 'es/noticias/noticias/concesionaria-dinamica-hace-la-entrega-de-estrela-en-nova-mutum-mt'],
            ['slug_from' => 'es/productos-servicios/maquinas-agricolas-es/distribuidores-1/bruttus-12000', 'slug_to' => 'es/productos-servicios/maquinas-agricolas-es/distribuidores-1/bruttus-25000-18000-y-12000'],
            ['slug_from' => 'es/productos-servicios/maquinas-agricolas-es/distribuidores-1/bruttus-25000-18000-el-12000', 'slug_to' => 'es/productos-servicios/maquinas-agricolas-es/distribuidores-1/bruttus-25000-18000-y-12000'],
            ['slug_from' => 'es/productos-servicios/maquinas-agricolas-es/distribuidores-1/hercules-15000-y-10000-inox', 'slug_to' => 'es/productos-servicios/maquinas-agricolas-es/distribuidores-1/hercules-24000-15000-y-10000-inox'],
            ['slug_from' => 'es/productos-servicios/maquinas-agricolas-es/distribuidores-1/tornado-1300-es', 'slug_to' => 'es/productos-servicios/maquinas-agricolas-es/distribuidores-1/twister-1500'],
            ['slug_from' => 'es/produto/conecta', 'slug_to' => 'es/productos-servicios/servicios/servicio/conecta'],
            ['slug_from' => 'es/produto/imperador-3-0', 'slug_to' => 'es/productos-servicios/maquinas-agricolas-es/pulverizadores/imperador-30'],
            ['slug_from' => 'es/produto/veris-ce', 'slug_to' => 'es/productos-servicios/agricultura-de-precision/producto/veris-ce'],
            ['slug_from' => 'es/stara-lanza-4-nuevas-maquinas-en-la-expodireto-2016', 'slug_to' => 'es/noticias/ferias-y-eventos/stara-lanza-4-nuevas-maquinas-en-la-expodireto-2016'],
            ['slug_from' => 'fale-conosco/marketing', 'slug_to' => 'fale-conosco/outros'],
            ['slug_from' => 'fale-conosco/representante', 'slug_to' => 'fale-conosco/outros'],
            ['slug_from' => 'links-mundo-stara.WEBPortal', 'slug_to' => ''],
            ['slug_from' => 'noticias/-/stara-leva-o-novo-pulverizador-inteligente-imperador-4000-eco-spray-a-agrishow-2024-em-colaboracao-com-a-one-smart-spray-2/0', 'slug_to' => 'noticias/feiras-e-eventos/stara-leva-o-novo-pulverizador-inteligente-imperador-4000-eco-spray-a-agrishow-2024-em-colaboracao-com-a-one-smart-spray-2'],
            ['slug_from' => 'noticias/departamento-de-', 'slug_to' => 'noticias/departamento-de-rede'],
            ['slug_from' => 'produto/conecta', 'slug_to' => 'produtos-servicos/servicos/servico/conecta'],
            ['slug_from' => 'produto/hercules-7000-10000-inox/hercules-24000', 'slug_to' => 'produtos-servicos/maquinas-agricolas/distribuidores/hercules-24000-15000-e-10000-inox'],
            ['slug_from' => 'produtos-servicos/implementos-agricolas/plataformas-de-milho/plataforma-brava', 'slug_to' => 'produtos-servicos/implementos-agricolas/plataformas-de-milho/brava'],
            ['slug_from' => 'produtos-servicos/maquinas-agricolas/distribuidores/bruttus-12000', 'slug_to' => 'produtos-servicos/maquinas-agricolas/distribuidores/bruttus-25000-18000-e-12000'],
            ['slug_from' => 'produtos-servicos/maquinas-agricolas/distribuidores/hercules-15000-e-10000-inox', 'slug_to' => 'produtos-servicos/maquinas-agricolas/distribuidores/hercules-24000-15000-e-10000-ino'],
            ['slug_from' => 'produtos-servicos/outros-produtos/produto/lubrificantes-stara', 'slug_to' => 'produtos-servicos/outros-produtos/produto/oleos-lubrificantes-e-protetivos'],
            ['slug_from' => 'ru/produkty-servisy/agregatiruemoe-sx-oborudovanie/bunkery-peregruzciki/reboke-11000-и-15000', 'slug_to' => 'ru/produkty-servisy/agregatiruemoe-sx-oborudovanie/bunkery-peregruzciki/reboke-11000-i-15000'],
            ['slug_from' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/opryskivateli/imperador-2000-и-2000-pv', 'slug_to' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/opryskivateli/imperador-2000-i-2000-pv'],
            ['slug_from' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/razbrasyvateli/bruttus-25000', 'slug_to' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/razbrasyvateli/bruttus-25000-18000-i-12000'],
            ['slug_from' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/razbrasyvateli/hercules-15000-i-10000-inox', 'slug_to' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/razbrasyvateli/hercules-24000-15000-i-10000-inox'],
            ['slug_from' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/razbrasyvateli/hercules-4-0', 'slug_to' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/razbrasyvateli/hercules-40'],
            ['slug_from' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/razbrasyvateli/hercules-4-0-ru', 'slug_to' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/razbrasyvateli/hercules-40'],
            ['slug_from' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/razbrasyvateli/hercules-6-0', 'slug_to' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/razbrasyvateli/hercules-60'],
            ['slug_from' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/razbrasyvateli/hercules-6-0-ru', 'slug_to' => 'ru/produkty-servisy/selskoxoziaistvennaia-texnika/razbrasyvateli/hercules-60'],
            ['slug_from' => 'ru/produto/brava', 'slug_to' => 'produtos-servicos/implementos-agricolas/plataformas-de-milho/brava'],
            ['slug_from' => 'ru/produto/rebokes-inox-2', 'slug_to' => 'ru/produkty-servisy/agregatiruemoe-sx-oborudovanie/bunkery-peregruzciki/reboke-inox'],
            ['slug_from' => 'ru/produto/rebokes-inox', 'slug_to' => 'ru/produkty-servisy/agregatiruemoe-sx-oborudovanie/bunkery-peregruzciki/reboke-inox'],
            ['slug_from' => 'ru/produto/telemetria-stara', 'slug_to' => 'ru/produkty-servisy/uslugi/usluga/sistema-telemetrii-stara'],
            ['slug_from' => 'web/index.php?menu=produtos&language=pt', 'slug_to' => 'produtos-servicos'],
            ['slug_from' => 'noticias/departamento-de-rede/o-que-e-agricultura-de-precisao', 'slug_to' => 'noticias/dicas-e-conteudos/agricultura-de-precisao-guia-completo'],
            ['slug_from' => 'produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-tornado-1300', 'slug_to' => 'produtos-servicos/maquinas-agricolas/distribuidores']
        ];

        foreach ($redirects as $redirect) {
            RedirectModel::firstOrCreate([
                'slug_from' => $redirect['slug_from'],
                'slug_to' => $redirect['slug_to']
            ]);
        }
    }


    public function down(): void
    {
        // Schema::table('categories_translations', function (Blueprint $table) {
        //     $table->text('hero_title')->nullable()->change();
        // });
    }
};
