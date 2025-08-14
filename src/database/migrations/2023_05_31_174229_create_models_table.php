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
        Schema::create('models', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id');
            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('image')->nullable();

            $table->string('thumb')->nullable();

            $table->string('url_360')->nullable();

            $table->timestamps();
        });

        Schema::create('models_translations', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('slug');

            $this->foreignTranslations($table, 'models', 'model_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models_translations');
        Schema::dropIfExists('models');
    }
};
