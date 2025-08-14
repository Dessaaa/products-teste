<?php

namespace App\Domains\Product\Models;

use App\Domains\Category\Enums\CategoryTypeEnum;
use App\Domains\Category\Models\CategoryModel;
use App\Domains\Model\Models\ModelModel;
use App\Domains\ProductDiff\Models\ProductDiffModel;
use App\Domains\ProductHome\Models\ProductHomeModel;
use App\Domains\ProductImage\Models\ProductImageModel;
use App\Domains\ProductsFaq\Models\ProductsFaqModel;
use App\Domains\ProductSolution\Models\ProductSolutionModel;
use App\Domains\ProductsTranslation\Models\ProductsTranslationModel;
use App\Domains\ProductSubcategory\Models\ProductSubcategoryModel;
use App\Domains\Solution\Models\SolutionModel;
use App\Domains\Subcategory\Models\SubcategoryModel;
use App\Models\Traits\BaseSeoTrait;
use App\Models\Traits\BaseTranslation;
use Astrotomic\Translatable\Translatable;
use BaseCms\BaseBlockBuilder\Models\BlockModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lang;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property integer $id
 * @property string $locale
 * @property string $slug
 * @property string $name
 * @property string $thumb
 * @property string $image_prospect
 * @property string $feature_first
 * @property string $order
 * @property string $hire_url
 * @property string $description
 * @property mixed $block_feature_id
 * @property mixed $block_cta_id
 * @property mixed $faq_id
 * @property mixed $form_product_id
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property ProductHomeModel[] $productHomes
 * @property ModelTechspec[] $modelTechspecs
 * @property Model[] $models
 * @property ProductCategory[] $productCategories
 * @property ProductGallery[] $productGalleries
 * @property ProductRelated[] $productRelateds
 * @property ProductSolution[] $solutions
 * @property ProductSubcategory[] $productSubcategories
 * @property Locale $locale
 */
class ProductModel extends Model implements Sortable
{
    use HasFactory;
    use LogsActivity;

    use SoftDeletes;

    use SortableTrait;

    /**
     * Translate
     */
    use BaseTranslation;
    use Translatable;

    use BaseSeoTrait;

    protected $connection = 'products'; // conexão com o banco de stara br

    public $translatedAttributes = [
        'name',
        'thumb',
        'thumb_seo',
        'image_prospect',
        'image_prospect_seo',
        'slug',
        'hire_url',
        'prospect',
        'description',
        'block_feature_id',
        'block_cta_id',

        'legend',
        'short_description',

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
    ];

    protected $translationForeignKey = 'product_id';

    protected $translationModel = ProductsTranslationModel::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = [
        'faq_id',
        'form_product_id',
        // 'image_prospect_mobile',
        'feature_first',
        'order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(CategoryModel::class, 'product_categories', 'product_id', 'category_id')
            ->orderByPivot('order')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productDiffs()
    {
        return $this->hasMany(ProductDiffModel::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function solutions()
    {
        return $this->belongsToMany(SolutionModel::class, 'product_solutions', 'product_id', 'solution_id')
            ->orderByPivot('order')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subcategories()
    {
        return $this->belongsToMany(SubcategoryModel::class, 'product_subcategories', 'product_id', 'subcategory_id')
            ->orderByPivot('order')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modelTechspecs()
    {
        return $this->hasMany('App\Domains\ModelTechspec\Models\ModelTechspecModel', 'model_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function models()
    {
        return $this->hasMany(ModelModel::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productCategories()
    {
        return $this->hasMany('App\Domains\ProductCategory\Models\ProductCategoryModel', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImages()
    {
        return $this->hasMany(ProductImageModel::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productHomes()
    {
        return $this->hasMany(ProductHomeModel::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productRelateds()
    {
        return $this->hasMany('App\Domains\ProductRelated\Models\ProductRelatedModel', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relateds()
    {
        return $this->belongsToMany(ProductModel::class, 'product_relateds', 'product_id', 'related_id')
            ->orderByPivot('order')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productSubcategories()
    {
        return $this->hasMany(ProductSubcategoryModel::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blockFeatureId()
    {
        return $this->belongsTo(BlockModel::class, 'block_feature_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faq()
    {
        return $this->hasMany(ProductsFaqModel::class, 'product_id')->orderBy('order');
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
        return \Database\Factories\ProductFactory::new();
    }

    /**
     * Atributo url dinâmico
     */
    public function getUrlAttribute()
    {
        // return \Cache::remember('product_url_' . $this->id . '_' . app()->getLocale(), 1 * 60, function () {
        $slugSubcategory = $this->subcategories && count($this->subcategories) > 0 ? $this->subcategories[0]->slug : '';

        if ($slugSubcategory) {
            $slugCategory = @$this->subcategories[0]->category->slug;
        } else {
            $slugCategory = @$this->categories[0]->slug;
        }

        //Produto/Serviço direto, atrelado a uma categoria
        if (!$slugSubcategory && $this->categories->count() > 0) {
            $slugSubcategory =
                $this->categories[0]->type == CategoryTypeEnum::Products
                ? Lang::get('routes.slug_produto')
                : Lang::get('routes.slug_servico');
        }

        return routeLocale('frontend.products.product', [
            'slugCategory' => @$slugCategory ?: '-',
            'slugSubcategory' => @$slugSubcategory ?: '-',
            'slugProduct' => @$this->slug ?: '-',
        ]);
        // });
    }
}
