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
        Schema::create('model_techspecs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('model_id');
            $table
                ->foreign('model_id')
                ->references('id')
                ->on('models')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('techspec_id');
            $table
                ->foreign('techspec_id')
                ->references('id')
                ->on('techspecs')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('order');

            $table->unique(['model_id', 'techspec_id']);

            $table->timestamps();
        });

        Schema::create('model_techspecs_translations', function (Blueprint $table) {
            $table->id();

            $table->string('value');

            $this->foreignTranslations($table, 'model_techspecs', 'model_techspec_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_techspecs_translations');
        Schema::dropIfExists('model_techspecs');
    }
};
