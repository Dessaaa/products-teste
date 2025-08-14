<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products_translations', function (Blueprint $table) {
            $table->text('text_360')->nullable();
            $table->text('text_specification')->nullable();
            $table->text('text_related')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products_translations', function (Blueprint $table) {
            $table->dropColumn(['text_360', 'text_specification', 'text_related'])->nullable();
        });
    }
};
