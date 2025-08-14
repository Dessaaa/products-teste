<?php

namespace App\Domains\ProductsTranslation\Models;

use App\Domains\Product\Models\ProductModel;
use App\Domains\ProductCategory\Models\ProductCategoryModel;
use App\Domains\ProductSubcategory\Models\ProductSubcategoryModel;
use App\View\Components\Frontend\Block\SectionCta;
use App\View\Components\Frontend\Block\SectionCtaInfo;
use App\View\Components\Frontend\Block\SectionFeature;
use BaseCms\BaseBlockBuilder\Models\BlockModel;
use BaseCms\Models\LocaleModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property integer $id
 * @property string $locale
 * @property integer $product_id
 * @property string $name
 * @property string $slug
 * @property string $hire_url
 * @property string $prospect
 * @property string $description
 * @property mixed $block_feature_id
 * @property mixed $block_cta_id
 * @property string $text_360
 * @property string $text_specification
 * @property string $text_related
 * @property string $text_differential
 * @property string $legend
 * @property string $search
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Locale $locale
 * @property Product $product
 */
class ProductsTranslationModel extends Model
{
    use HasFactory;
    use LogsActivity;
    use HasSlug;

    protected $connection = 'products'; // conexão com o banco de stara br

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'locale',
        'product_id',
        'block_feature_id',
        'block_cta_id',
        'hire_url',
        'prospect',
        'name',
        'thumb',
        'thumb_seo',
        'image_prospect',
        'image_prospect_seo',
        'slug',
        'description',

        'short_description',
        'legend',
        'search',
        'text_360',
        'text_specification',
        'text_related',
        'text_differential',

        'faq_title',
        'faq_text',
        'tags_title',
        'tags_categories',
        'tags_subcategories',
        'free_text',

        'created_at',
        'updated_at',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function (ProductsTranslationModel $model) {
            $model->search = join(', ', [
                $model->name,
                strip_tags($model->description),
                $model
                    ->product()
                    ->withTrashed()
                    ->first()
                    ->categories->pluck('name'),
                $model
                    ->product()
                    ->withTrashed()
                    ->first()
                    ->subcategories->pluck('name'),
            ]);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function locale()
    {
        return $this->belongsTo(LocaleModel::class, 'locale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    /**
     *
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->allowDuplicateSlugs()
            ->doNotGenerateSlugsOnUpdate();

        // ->preventOverwrite();
    }

    /**
     * Logs
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Database\Factories\ProductTranslationFactory::new();
    }
}
