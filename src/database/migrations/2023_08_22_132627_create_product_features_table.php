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
        Schema::create('product_features', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id');
            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('image')->nullable();
            $table->integer('order');

            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('product_features_translations', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();

            $table->string('text')->nullable();

            $this->foreignTranslations($table, 'product_features', 'product_feature_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_features');
    }
};
