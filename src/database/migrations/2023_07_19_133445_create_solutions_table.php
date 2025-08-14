<?php

use App\Domains\ProductSolution\Enums\ProductSolutionTypeEnum;
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
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();

            //Para fazer a ligação com o SVG, por hora a imagem nao fica dinâmica
            $table->enum('type', ProductSolutionTypeEnum::asArray())->default('outros');

            $table->string('thumb')->nullable(); //340

            $table->integer('order');

            $table->timestamps();

            $table->softDeletes();

            $table->unique(['type']);
        });

        Schema::create('solutions_translations', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('slug');

            $table->string('hero_title')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_image_mobile')->nullable();
            $table->enum('hero_align', ['left', 'center', 'right']);

            $this->foreignTranslations($table, 'solutions', 'solution_id');

            $table->unique(['locale', 'slug']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solutions_translations');

        Schema::dropIfExists('solutions');
    }
};
