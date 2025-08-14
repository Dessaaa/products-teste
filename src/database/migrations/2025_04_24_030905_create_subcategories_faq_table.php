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
        Schema::create('subcategories_faq', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('subcategory_id')
                ->references('id')
                ->on('subcategories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('subcategories_faq_translations', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('text');
            $this->foreignTranslations($table, 'subcategories_faq', 'subcategories_faq_id');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subcategories_faq_translations');
        Schema::dropIfExists('subcategories_faq');
    }
};
