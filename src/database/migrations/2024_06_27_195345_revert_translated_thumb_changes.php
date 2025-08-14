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
        if (Schema::hasColumn('products_translations', 'thumb_translated')) {
            Schema::table('products_translations', function (Blueprint $table) {
                $table->dropColumn('thumb_translated');
            });
        }

        if (Schema::hasColumn('product_images', 'image_en') && Schema::hasColumn('product_images', 'image_es') && Schema::hasColumn('product_images', 'image_ru')) {
            Schema::table('product_images', function (Blueprint $table) {
                $table->dropColumn(['image_en', 'image_es', 'image_ru']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn(['image_en', 'image_es', 'image_ru']);
        });
    }
};
