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
        Schema::create('categories_faq', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('categories_faq_translations', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('text');
            $this->foreignTranslations($table, 'categories_faq', 'categories_faq_id');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories_faq_translations');
        Schema::dropIfExists('categories_faq');
    }
};
