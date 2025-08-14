<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('subcategories_translations', function (Blueprint $table) {
            // FAQ
            $table->string('faq_title')->nullable()->after('text_right');
            $table->text('faq_text')->nullable()->after('faq_title');
            // TAGS
            $table->string('tags_title')->nullable()->after('faq_text');
            $table->string('tags_categories')->nullable()->after('tags_title');
            $table->string('tags_subcategories')->nullable()->after('tags_categories');
            // FREE TEXT
            $table->text('free_text')->nullable()->after('tags_subcategories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subcategories_translations', function (Blueprint $table) {
            // FAQ
            $table->dropColumn('faq_title');
            $table->dropColumn('faq_text');
            // TAGS
            $table->dropColumn('tags_title');
            $table->dropColumn('tags_categories');
            $table->dropColumn('tags_subcategories');
            // FREE TEXT
            $table->dropColumn('free_text');
        });
    }
};
