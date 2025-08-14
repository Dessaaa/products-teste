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
        Schema::create('faq_items', function (Blueprint $table) {
            $table->id();

            $table->integer('order');

            $table->foreignId('faq_tab_id');

            $table
                ->foreign('faq_tab_id')
                ->references('id')
                ->on('faq_tabs')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::create('faq_items_translations', function (Blueprint $table) {
            $table->id();

            $table->string('question');

            $table->string('answer');

            $this->foreignTranslations($table, 'faq_items', 'faq_item_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_items_translations');
        Schema::dropIfExists('faq_items');
    }
};
