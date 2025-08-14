<?php

use App\Models\Traits\BaseTranslationMigration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use BaseTranslationMigration;

    public function up(): void
    {
        Schema::create('products_faq', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('products_faq_translations', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('text');
            $this->foreignTranslations($table, 'products_faq', 'products_faq_id');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products_faq_translations');
        Schema::dropIfExists('products_faq');
    }
};
