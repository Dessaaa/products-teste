<?php

use App\Domains\ProductsTranslation\Models\ProductsTranslationModel;
use App\Domains\Redirect\Models\RedirectModel;
use App\Domains\SubcategoriesTranslation\Models\SubcategoriesTranslationModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $renameSubcategories = [
            [
                'name' => 'Escarificadores',
                'old_slug' => 'escarificador',
                'new_slug' => 'escarificadores',
                'old_url' => '/produtos-servicos/implementos-agricolas/escarificador',
                'new_url' => '/produtos-servicos/implementos-agricolas/escarificadores',
            ],
            [
                'name' => 'Plainas Agrícolas',
                'old_slug' => 'plaina-agricola-dianteira',
                'new_slug' => 'plainas-agricolas',
                'old_url' => '/produtos-servicos/implementos-agricolas/plaina-agricola-dianteira',
                'new_url' => '/produtos-servicos/implementos-agricolas/plainas-agricolas',
            ],
            [
                'name' => 'Niveladores de Solo Agrícolas',
                'old_slug' => 'niveladores-de-solo',
                'new_slug' => 'niveladores-de-solo-agricolas',
                'old_url' => '/produtos-servicos/implementos-agricolas/niveladores-de-solo',
                'new_url' => '/produtos-servicos/implementos-agricolas/niveladores-de-solo-agricolas',
            ],
        ];

        foreach ($renameSubcategories as $rename) {
            SubcategoriesTranslationModel::query()
                ->where('locale', 'pt_BR')
                ->where('slug', $rename['old_slug'])
                ->update(['slug' => $rename['new_slug'], 'name' => $rename['name']]);

            RedirectModel::query()
                ->where('slug_from', $rename['old_url'])
                ->where('slug_to', $rename['new_url'])
                ->firstOrCreate([
                    'slug_from' => $rename['old_url'],
                    'slug_to' => $rename['new_url'],
                ]);
        }

        $renameProducts = [
            [
                'old_slug' => 'imperador-3000-e-4000',
                'new_slug' => 'pulverizador-agricola-autopropelido-imperador-3000-e-4000',
                'old_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/imperador-3000-e-4000',
                'new_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/pulverizador-agricola-autopropelido-imperador-3000-e-4000',
            ],
            [
                'old_slug' => 'imperador-30',
                'new_slug' => 'pulverizador-agricola-autopropelido-distribuidor-imperador-30',
                'old_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/imperador-30',
                'new_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/pulverizador-agricola-autopropelido-distribuidor-imperador-30',
            ],
            [
                'old_slug' => 'imperador-2000-e-2000-pv',
                'new_slug' => 'pulverizador-agricola-imperador-2000-e-2000-pv',
                'old_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/imperador-2000-e-2000-pv',
                'new_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/pulverizador-agricola-imperador-2000-e-2000-pv',
            ],
            [
                'old_slug' => 'imperador-2500',
                'new_slug' => 'pulverizador-agricola-imperador-2500',
                'old_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/imperador-2500',
                'new_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/pulverizador-agricola-imperador-2500',
            ],
            [
                'old_slug' => 'absoluta',
                'new_slug' => 'plantadeira-absoluta',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/absoluta',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/plantadeira-absoluta',
            ],
            [
                'old_slug' => 'estrela',
                'new_slug' => 'plantadeira-estrela',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/estrela',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/plantadeira-estrela',
            ],
            [
                'old_slug' => 'princesa',
                'new_slug' => 'plantadeira-princesa',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/princesa',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/plantadeira-princesa',
            ],
            [
                'old_slug' => 'linha-guapa',
                'new_slug' => 'semeadora-agricola-linha-guapa',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/linha-guapa',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/semeadora-agricola-linha-guapa',
            ],
            [
                'old_slug' => 'guapita',
                'new_slug' => 'semeadora-agricola-guapita',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/guapita',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/semeadora-agricola-guapita',
            ],
            [
                'old_slug' => 'eva',
                'new_slug' => 'plantadeira-eva',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/eva',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/plantadeira-eva',
            ],
            [
                'old_slug' => 'ceres-e-ceres-master',
                'new_slug' => 'semeadora-agricola-ceres-e-ceres-master',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/ceres-e-ceres-master',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/semeadora-agricola-ceres-e-ceres-master',
            ],
            [
                'old_slug' => 'cinderela',
                'new_slug' => 'plantadeira-cinderela',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/cinderela',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/plantadeira-cinderela',
            ],
            [
                'old_slug' => 'hercules-40',
                'new_slug' => 'distribuidor-agricola-hercules-40',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/hercules-40',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-hercules-40',
            ],
            [
                'old_slug' => 'hercules-60',
                'new_slug' => 'distribuidor-agricola-hercules-60',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/hercules-60',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-hercules-60',
            ],
            [
                'old_slug' => 'bruttus-25000-18000-e-12000',
                'new_slug' => 'distribuidor-agricola-bruttus-25000-18000-e-12000',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/bruttus-25000-18000-e-12000',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-bruttus-25000-18000-e-12000',
            ],
            [
                'old_slug' => 'hercules-24000-c',
                'new_slug' => 'distribuidor-agricola-hercules-24000-c',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/hercules-24000-c',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-hercules-24000-c',
            ],
            [
                'old_slug' => 'hercules-24000-15000-e-10000-inox',
                'new_slug' => 'distribuidor-agricola-hercules-24000-15000-e-10000-inox',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/hercules-24000-15000-e-10000-inox',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-hercules-24000-15000-e-10000-inox',
            ],
            [
                'old_slug' => 'twister-1500',
                'new_slug' => 'distribuidor-agricola-twister-1500',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/twister-1500',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-twister-1500',
            ],
            [
                'old_slug' => 'tornado-1300',
                'new_slug' => 'distribuidor-agricola-tornado-1300',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/tornado-1300',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-tornado-1300',
            ],
            [
                'old_slug' => 'reboke-inox',
                'new_slug' => 'carreta-agricola-reboke-inox',
                'old_url' => '/produtos-servicos/implementos-agricolas/carretas-agricolas/reboke-inox',
                'new_url' => '/produtos-servicos/implementos-agricolas/carretas-agricolas/carreta-agricola-reboke-inox',
            ],
            [
                'old_slug' => 'reboke-ninja',
                'new_slug' => 'carreta-agricola-reboke-ninja',
                'old_url' => '/produtos-servicos/implementos-agricolas/carretas-agricolas/reboke-ninja',
                'new_url' => '/produtos-servicos/implementos-agricolas/carretas-agricolas/carreta-agricola-reboke-ninja',
            ],
            [
                'old_slug' => 'reboke-11000-e-15000',
                'new_slug' => 'carreta-agricola-reboke-11000-e-15000',
                'old_url' => '/produtos-servicos/implementos-agricolas/carretas-agricolas/reboke-11000-e-15000',
                'new_url' => '/produtos-servicos/implementos-agricolas/carretas-agricolas/carreta-agricola-reboke-11000-e-15000',
            ],
            [
                'old_slug' => 'brava',
                'new_slug' => 'plataforma-de-milho-brava',
                'old_url' => '/produtos-servicos/implementos-agricolas/plataformas-de-milho/brava',
                'new_url' => '/produtos-servicos/implementos-agricolas/plataformas-de-milho/plataforma-de-milho-brava',
            ],
            [
                'old_slug' => 'fox',
                'new_slug' => 'escarificador-fox',
                'old_url' => '/produtos-servicos/implementos-agricolas/escarificador/fox',
                'new_url' => '/produtos-servicos/implementos-agricolas/escarificadores/escarificador-fox',
            ],
            [
                'old_slug' => 'pad',
                'new_slug' => 'plaina-agricola-dianteira-pad',
                'old_url' => '/produtos-servicos/implementos-agricolas/plaina-agricola-dianteira/pad',
                'new_url' => '/produtos-servicos/implementos-agricolas/plainas-agricolas/plaina-agricola-dianteira-pad',
            ],
            [
                'old_slug' => 'asa-laser-canavieiro',
                'new_slug' => 'subsolador-asa-laser-canavieiro',
                'old_url' => '/produtos-servicos/implementos-agricolas/subsoladores-implementos-agricolas/asa-laser-canavieiro',
                'new_url' => '/produtos-servicos/implementos-agricolas/subsoladores-implementos-agricolas/subsolador-asa-laser-canavieiro',
            ],
            [
                'old_slug' => 'starplan',
                'new_slug' => 'plaina-hidraulica-niveladora-starplan',
                'old_url' => '/produtos-servicos/implementos-agricolas/niveladores-de-solo/starplan',
                'new_url' => '/produtos-servicos/implementos-agricolas/niveladores-de-solo-agricolas/plaina-hidraulica-niveladora-starplan',
            ],
            [
                'old_slug' => 'oleos-lubrificantes-e-protetivos',
                'new_slug' => 'oleos-lubrificantes-e-protetivos-para-maquinas-agricolas',
                'old_url' => '/produtos-servicos/outros-produtos/produto/oleos-lubrificantes-e-protetivos',
                'new_url' => '/produtos-servicos/outros-produtos/produto/oleos-lubrificantes-e-protetivos-para-maquinas-agricolas ',
            ],
            [
                'old_slug' => 'bicos-de-pulverizacao',
                'new_slug' => 'bicos-de-pulverizacao-agricola',
                'old_url' => '/produtos-servicos/outros-produtos/produto/bicos-de-pulverizacao',
                'new_url' => '/produtos-servicos/outros-produtos/produto/bicos-de-pulverizacao-agricola',
            ],
        ];

        foreach ($renameProducts as $rename) {
            ProductsTranslationModel::query()
                ->where('locale', 'pt_BR')
                ->where('slug', $rename['old_slug'])
                ->update(['slug' => $rename['new_slug']]);

            RedirectModel::query()
                ->where('slug_from', $rename['old_url'])
                ->where('slug_to', $rename['new_url'])
                ->firstOrCreate([
                    'slug_from' => $rename['old_url'],
                    'slug_to' => $rename['new_url'],
                ]);
        }
    }

    public function down(): void
    {
        $renameSubcategories = [
            [
                'name' => 'Escarificador',
                'old_slug' => 'escarificadores',
                'new_slug' => 'escarificador',
                'old_url' => '/produtos-servicos/implementos-agricolas/escarificadores',
                'new_url' => '/produtos-servicos/implementos-agricolas/escarificador',
            ],
            [
                'name' => 'Plaina Agrícola Dianteira',
                'old_slug' => 'plainas-agricolas',
                'new_slug' => 'plaina-agricola-dianteira',
                'old_url' => '/produtos-servicos/implementos-agricolas/plainas-agricolas',
                'new_url' => '/produtos-servicos/implementos-agricolas/plaina-agricola-dianteira',
            ],
            [
                'name' => 'Niveladores de Solo',
                'old_slug' => 'niveladores-de-solo-agricolas',
                'new_slug' => 'niveladores-de-solo',
                'old_url' => '/produtos-servicos/implementos-agricolas/niveladores-de-solo-agricolas',
                'new_url' => '/produtos-servicos/implementos-agricolas/niveladores-de-solo',
            ],
        ];

        foreach ($renameSubcategories as $rename) {
            SubcategoriesTranslationModel::query()
                ->where('locale', 'pt_BR')
                ->where('slug', $rename['old_slug'])
                ->update(['slug' => $rename['new_slug'], 'name' => $rename['name']]);

            RedirectModel::query()
                ->where('slug_from', $rename['old_url'])
                ->where('slug_to', $rename['new_url'])
                ->delete();
        }

        $renameProducts = [
            [
                'new_slug' => 'imperador-3000-e-4000',
                'old_slug' => 'pulverizador-agricola-autopropelido-imperador-3000-e-4000',
                'new_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/imperador-3000-e-4000',
                'old_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/pulverizador-agricola-autopropelido-imperador-3000-e-4000',
            ],
            [
                'new_slug' => 'imperador-30',
                'old_slug' => 'pulverizador-agricola-autopropelido-distribuidor-imperador-30',
                'new_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/imperador-30',
                'old_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/pulverizador-agricola-autopropelido-distribuidor-imperador-30',
            ],
            [
                'new_slug' => 'imperador-2000-e-2000-pv',
                'old_slug' => 'pulverizador-agricola-imperador-2000-e-2000-pv',
                'new_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/imperador-2000-e-2000-pv',
                'old_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/pulverizador-agricola-imperador-2000-e-2000-pv',
            ],
            [
                'new_slug' => 'imperador-2500',
                'old_slug' => 'pulverizador-agricola-imperador-2500',
                'new_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/imperador-2500',
                'old_url' => '/produtos-servicos/maquinas-agricolas/pulverizadores-maquinas-agricolas/pulverizador-agricola-imperador-2500',
            ],
            [
                'new_slug' => 'absoluta',
                'old_slug' => 'plantadeira-absoluta',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/absoluta',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/plantadeira-absoluta',
            ],
            [
                'new_slug' => 'estrela',
                'old_slug' => 'plantadeira-estrela',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/estrela',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/plantadeira-estrela',
            ],
            [
                'new_slug' => 'princesa',
                'old_slug' => 'plantadeira-princesa',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/princesa',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/plantadeira-princesa',
            ],
            [
                'new_slug' => 'linha-guapa',
                'old_slug' => 'semeadora-agricola-linha-guapa',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/linha-guapa',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/semeadora-agricola-linha-guapa',
            ],
            [
                'new_slug' => 'guapita',
                'old_slug' => 'semeadora-agricola-guapita',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/guapita',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/semeadora-agricola-guapita',
            ],
            [
                'new_slug' => 'eva',
                'old_slug' => 'plantadeira-eva',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/eva',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/plantadeira-eva',
            ],
            [
                'new_slug' => 'ceres-e-ceres-master',
                'old_slug' => 'semeadora-agricola-ceres-e-ceres-master',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/ceres-e-ceres-master',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/semeadora-agricola-ceres-e-ceres-master',
            ],
            [
                'new_slug' => 'cinderela',
                'old_slug' => 'plantadeira-cinderela',
                'new_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/cinderela',
                'old_url' => '/produtos-servicos/maquinas-agricolas/plantadeiras-e-semeadoras/plantadeira-cinderela',
            ],
            [
                'new_slug' => 'hercules-40',
                'old_slug' => 'distribuidor-agricola-hercules-40',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/hercules-40',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-hercules-40',
            ],
            [
                'new_slug' => 'hercules-60',
                'old_slug' => 'distribuidor-agricola-hercules-60',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/hercules-60',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-hercules-60',
            ],
            [
                'new_slug' => 'bruttus-25000-18000-e-12000',
                'old_slug' => 'distribuidor-agricola-bruttus-25000-18000-e-12000',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/bruttus-25000-18000-e-12000',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-bruttus-25000-18000-e-12000',
            ],
            [
                'new_slug' => 'hercules-24000-c',
                'old_slug' => 'distribuidor-agricola-hercules-24000-c',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/hercules-24000-c',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-hercules-24000-c',
            ],
            [
                'new_slug' => 'hercules-24000-15000-e-10000-inox',
                'old_slug' => 'distribuidor-agricola-hercules-24000-15000-e-10000-inox',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/hercules-24000-15000-e-10000-inox',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-hercules-24000-15000-e-10000-inox',
            ],
            [
                'new_slug' => 'twister-1500',
                'old_slug' => 'distribuidor-agricola-twister-1500',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/twister-1500',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-twister-1500',
            ],
            [
                'new_slug' => 'tornado-1300',
                'old_slug' => 'distribuidor-agricola-tornado-1300',
                'new_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/tornado-1300',
                'old_url' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-tornado-1300',
            ],
            [
                'new_slug' => 'reboke-inox',
                'old_slug' => 'carreta-agricola-reboke-inox',
                'new_url' => '/produtos-servicos/implementos-agricolas/carretas-agricolas/reboke-inox',
                'old_url' => '/produtos-servicos/implementos-agricolas/carretas-agricolas/carreta-agricola-reboke-inox',
            ],
            [
                'new_slug' => 'reboke-ninja',
                'old_slug' => 'carreta-agricola-reboke-ninja',
                'new_url' => '/produtos-servicos/implementos-agricolas/carretas-agricolas/reboke-ninja',
                'old_url' => '/produtos-servicos/implementos-agricolas/carretas-agricolas/carreta-agricola-reboke-ninja',
            ],
            [
                'new_slug' => 'reboke-11000-e-15000',
                'old_slug' => 'carreta-agricola-reboke-11000-e-15000',
                'new_url' => '/produtos-servicos/implementos-agricolas/carretas-agricolas/reboke-11000-e-15000',
                'old_url' => '/produtos-servicos/implementos-agricolas/carretas-agricolas/carreta-agricola-reboke-11000-e-15000',
            ],
            [
                'new_slug' => 'brava',
                'old_slug' => 'plataforma-de-milho-brava',
                'new_url' => '/produtos-servicos/implementos-agricolas/plataformas-de-milho/brava',
                'old_url' => '/produtos-servicos/implementos-agricolas/plataformas-de-milho/plataforma-de-milho-brava',
            ],
            [
                'new_slug' => 'fox',
                'old_slug' => 'escarificador-fox',
                'new_url' => '/produtos-servicos/implementos-agricolas/escarificador/fox',
                'old_url' => '/produtos-servicos/implementos-agricolas/escarificadores/escarificador-fox',
            ],
            [
                'new_slug' => 'pad',
                'old_slug' => 'plaina-agricola-dianteira-pad',
                'new_url' => '/produtos-servicos/implementos-agricolas/plaina-agricola-dianteira/pad',
                'old_url' => '/produtos-servicos/implementos-agricolas/plainas-agricolas/plaina-agricola-dianteira-pad',
            ],
            [
                'new_slug' => 'asa-laser-canavieiro',
                'old_slug' => 'subsolador-asa-laser-canavieiro',
                'new_url' => '/produtos-servicos/implementos-agricolas/subsoladores-implementos-agricolas/asa-laser-canavieiro',
                'old_url' => '/produtos-servicos/implementos-agricolas/subsoladores-implementos-agricolas/subsolador-asa-laser-canavieiro',
            ],
            [
                'new_slug' => 'starplan',
                'old_slug' => 'plaina-hidraulica-niveladora-starplan',
                'new_url' => '/produtos-servicos/implementos-agricolas/niveladores-de-solo/starplan',
                'old_url' => '/produtos-servicos/implementos-agricolas/niveladores-de-solo-agricolas/plaina-hidraulica-niveladora-starplan',
            ],
            [
                'new_slug' => 'oleos-lubrificantes-e-protetivos',
                'old_slug' => 'oleos-lubrificantes-e-protetivos-para-maquinas-agricolas',
                'new_url' => '/produtos-servicos/outros-produtos/produto/oleos-lubrificantes-e-protetivos',
                'old_url' => '/produtos-servicos/outros-produtos/produto/oleos-lubrificantes-e-protetivos-para-maquinas-agricolas ',
            ],
            [
                'new_slug' => 'bicos-de-pulverizacao',
                'old_slug' => 'bicos-de-pulverizacao-agricola',
                'new_url' => '/produtos-servicos/outros-produtos/produto/bicos-de-pulverizacao',
                'old_url' => '/produtos-servicos/outros-produtos/produto/bicos-de-pulverizacao-agricola',
            ],
        ];

        foreach ($renameProducts as $rename) {
            ProductsTranslationModel::query()
                ->where('locale', 'pt_BR')
                ->where('slug', $rename['old_slug'])
                ->update(['slug' => $rename['new_slug']]);

            RedirectModel::query()
                ->where('slug_from', $rename['old_url'])
                ->where('slug_to', $rename['new_url'])
                ->delete();
        }
    }
};
