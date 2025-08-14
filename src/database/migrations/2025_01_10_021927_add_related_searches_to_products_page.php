<?php

use App\View\Components\Frontend\Block\BudgetBanner;
use App\View\Components\Frontend\Block\Faq;
use App\View\Components\Frontend\Block\RelatedSearches;
use BaseCms\BaseBlockBuilder\Models\BlockModel;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    use DisableForeignKeys;

    public function up(): void
    {
        $this->disableForeignKeys();

        \DB::transaction(function () {
            collect(validLocales())->map(function ($locale) {
                try {
                    // ORÇAMENTO
                    BlockModel::updateOrCreate(
                        ['locale' => $locale, 'key' => 'related_searches'],
                        [
                            'locale' => $locale,
                            'key' => 'related_searches',
                            'componentClass' => RelatedSearches::class,
                            'preview' => null,
                            'tags' => null,
                            'params' => (object)  [],
                            'fl_reusable' => 1,
                            'old_key' => null,
                            'deleted_at' => null,
                        ],
                    );
                } catch (\Illuminate\Database\QueryException $e) {
                    \Log::error('Não foi possível executar a migration p/ alteração da página da página.', [$e->getMessage()]);
                }
            });
        });

        $this->enableForeignKeys();
    }

    public function down(): void
    {
        $this->disableForeignKeys();

        \DB::transaction(function () {
            collect(validLocales())->map(function ($locale) {
                try {
                    BlockModel::where('key', 'related_searches')->delete();
                } catch (\Illuminate\Database\QueryException $e) {
                    \Log::error('Não foi possível executar a migration p/ alteração da página da página.', [$e->getMessage()]);
                }
            });
        });

        $this->enableForeignKeys();
    }
};
