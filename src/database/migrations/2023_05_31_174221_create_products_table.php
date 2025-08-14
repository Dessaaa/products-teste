<?php

use App\Models\Traits\BaseTranslationMigration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    use BaseTranslationMigration;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('thumb')->nullable();

            //TODO: faq/faqitem, tela de serviços (talvez virou um type dentro do FaqModel //avaliar)

            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('products_translations', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('slug');

            $table->string('hire_url')->nullable();

            $table->string('prospect')->nullable();

            $table->text('description')->nullable();

            //Estes dois ids não são mais utilizados, cliente decidiu manter o mesmo dado em todas as internas de produto
            $table->bigInteger('block_feature_id')->nullable();
            $table->bigInteger('block_cta_id')->nullable();

            $this->foreignTranslations($table, 'products', 'product_id');

            $table->unique(['locale', 'slug']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_translations');
        Schema::dropIfExists('products');
    }
};
