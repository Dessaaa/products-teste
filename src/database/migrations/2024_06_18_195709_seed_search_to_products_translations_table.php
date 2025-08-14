<?php

use App\Domains\ProductsTranslation\Models\ProductsTranslationModel;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        ProductsTranslationModel::get()->map(function ($v) {
            $v->update(['updated_at' => \Carbon\Carbon::now()]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
