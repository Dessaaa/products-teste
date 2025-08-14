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
        Schema::create('faq_tabs', function (Blueprint $table) {
            $table->id();

            $table->integer('order');

            $table->foreignId('faq_id');

            $table
                ->foreign('faq_id')
                ->references('id')
                ->on('faqs')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::create('faq_tabs_translations', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $this->foreignTranslations($table, 'faq_tabs', 'faq_tab_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_tabs_translations');
        Schema::dropIfExists('faq_tabs');
    }
};
