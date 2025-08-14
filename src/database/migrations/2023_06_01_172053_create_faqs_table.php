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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['contact', 'service'])->default('contact');

            $table->unique('type');

            $table->timestamps();
        });

        Schema::create('faqs_translations', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();

            $table->text('text')->nullable();

            $this->foreignTranslations($table, 'faqs', 'faq_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs_translations');
        Schema::dropIfExists('faqs');
    }
};
