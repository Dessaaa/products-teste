<?php

use App\Domains\Product\Models\ProductModel;
use App\Domains\ProductImagesTranslation\Models\ProductImagesTranslationModel;
use App\Domains\ProductsTranslation\Models\ProductsTranslationModel;
use BaseCms\Models\LocaleModel;
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
        // Adiciona as colunas thumb e image_prospect na tabela products_translations
        Schema::table('products_translations', function (Blueprint $table) {
            $table->string('thumb')->after('slug')->nullable();
            $table->string('image_prospect')->after('thumb')->nullable();
        });

        $products = ProductModel::all();
        $locales = LocaleModel::where('enabled', true)->get();

        foreach ($products as $product) {
            // Atualiza as colunas thumb e image_prospect na tabela products_translations
            foreach ($locales as $locale) {
                if ($product->hasTranslation($locale->id)) {
                    ProductsTranslationModel::where('product_id', $product->id)->where('locale', $locale->id)->update([
                        'thumb' => $product->getRawOriginal('thumb'),
                        'image_prospect' => $product->getRawOriginal('image_prospect'),
                    ]);
                }
            }

            // Cria as traduções das imagens dos produtos
            foreach ($product->productImages as $image) {
                if (!$image->hasTranslation('pt_BR')) {
                    ProductImagesTranslationModel::firstOrCreate([
                        'product_images_id' => $image->id,
                        'locale' => 'pt_BR',
                    ], [
                        'image' => $image->image,
                        'video' => $image->video,
                    ]);

                    if ($image->video_en) {
                        ProductImagesTranslationModel::firstOrCreate([
                            'product_images_id' => $image->id,
                            'locale' => 'en',
                        ], [
                            'image' => $image->image,
                            'video' => $image->video_en,
                        ]);
                    }
                    if ($image->video_es) {
                        ProductImagesTranslationModel::firstOrCreate([
                            'product_images_id' => $image->id,
                            'locale' => 'es',
                        ], [
                            'image' => $image->image,
                            'video' => $image->video_es,
                        ]);
                    }
                    if ($image->video_ru) {
                        ProductImagesTranslationModel::firstOrCreate([
                            'product_images_id' => $image->id,
                            'locale' => 'ru',
                        ], [
                            'image' => $image->image,
                            'video' => $image->video_ru,
                        ]);
                    }
                }
            }
        }

        // Remove as colunas thumb e image_prospect da tabela products
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['thumb', 'image_prospect']);
        });

        // Remove as colunas image, video, video_en, video_es e video_ru da tabela product_images
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn(['image', 'video', 'video_en', 'video_es', 'video_ru']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Adiciona as colunas thumb e image_prospect na tabela products
        Schema::table('products', function (Blueprint $table) {
            $table->string('thumb')->after('id')->nullable();
            $table->string('image_prospect')->after('thumb')->nullable();
        });

        // Atualiza as colunas thumb e image_prospect na tabela products
        $products = ProductModel::all();

        foreach ($products as $product) {
            $translation = ProductsTranslationModel::where('product_id', $product->id)->where('locale', 'pt_BR')->first();

            if ($translation) {
                $product->thumb = $translation->thumb;
                $product->image_prospect = $translation->image_prospect;
                $product->save();
            }
        }

        // Remove as colunas thumb e image_prospect da tabela products_translations
        Schema::table('products_translations', function (Blueprint $table) {
            $table->dropColumn('thumb');
            $table->dropColumn('image_prospect');
        });

        // Adiciona as colunas image, video, video_en, video_es e video_ru na tabela product_images
        Schema::table('product_images', function (Blueprint $table) {
            $table->string('image')->after('product_id')->nullable();
            $table->string('video')->after('image')->nullable();
            $table->string('video_en')->after('video')->nullable();
            $table->string('video_es')->after('video_en')->nullable();
            $table->string('video_ru')->after('video_es')->nullable();
        });

        $productImages = ProductImagesTranslationModel::all();

        // Atualiza as colunas image, video, video_en, video_es e video_ru na tabela product_images
        foreach ($productImages as $productImage) {
            $image = $productImage->productImage;

            if ($productImage->locale === 'pt_BR') {
                $image->image = $productImage->image;
                $image->video = $productImage->video;
            } elseif ($productImage->locale === 'en') {
                $image->video_en = $productImage->video;
            } elseif ($productImage->locale === 'es') {
                $image->video_es = $productImage->video;
            } elseif ($productImage->locale === 'ru') {
                $image->video_ru = $productImage->video;
            }

            $image->save();
        }

        // Remove as traduções das imagens dos produtos
        Schema::dropIfExists('product_images_translations');
    }
};
