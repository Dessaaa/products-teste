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
            $table->string('thumb_seo')->after('thumb')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subcategories_translations', function (Blueprint $table) {
            $table->dropColumn('thumb_seo');
        });
    }
};
