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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['products', 'services'])->default('products');

            $table->integer('order');

            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('categories_translations', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('slug');

            $table->string('hero_title')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_image_mobile')->nullable();
            $table->enum('hero_align', ['left', 'center', 'right']);

            $table->string('title_left')->nullable();
            $table->string('title_right')->nullable();
            $table->string('text_right')->nullable();

            $this->foreignTranslations($table, 'categories', 'category_id');
         
            $table->unique(['locale', 'slug']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_translations');
        Schema::dropIfExists('categories');
    }
};
