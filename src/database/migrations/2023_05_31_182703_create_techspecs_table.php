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
        Schema::create('techspecs', function (Blueprint $table) {
            $table->id();

            $table->string('key');

            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('techspecs_translations', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $this->foreignTranslations($table, 'techspecs', 'techspec_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('techspecs_translations');
        Schema::dropIfExists('techspecs');
    }
};
