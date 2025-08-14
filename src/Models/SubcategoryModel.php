<?php

namespace Products\Models;

use Products\Models\CategoryModel;
use Products\Models\ProductModel;
use Products\Models\ProductSubcategoryModel;
use Products\Models\SubcategoriesFaqModel;
use Products\Models\SubcategoriesTranslationModel;
use App\Models\Traits\BaseSeoTrait;
use App\Models\Traits\BaseTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use BaseCms\Models\BaseModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $slug
 * @property string $thumb
 * @property string $hero_title
 * @property string $hero_image
 * @property string $hero_image_mobile
 * @property string $hero_align
 * @property string $title_left
 * @property string $title_right
 * @property string $text_right
 * @property integer $order
 * @property mixed $deleted_at
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property ProductSubcategory[] $productSubcategories
 * @property Category $category
 */
class SubcategoryModel extends Model implements Sortable
{
    use HasFactory;
    use LogsActivity;

    use SortableTrait;
    use BaseModelTrait;

    use SoftDeletes;

    use BaseSeoTrait;

    /**
     * Translate
     */
    use BaseTranslation;
    use Translatable;

    protected $connection = 'products'; // conexão com o banco de stara br

    public $translatedAttributes = [
        'name',
        'slug',
        'thumb',
        'thumb_seo',
        'hero_title',
        'hero_image',
        'hero_image_mobile',
        'hero_align',
        'title_left',
        'title_right',
        'text_right',
        'faq_title',
        'faq_text',
        'tags_title',
        'tags_categories',
        'tags_subcategories',
        'free_text',
    ];

    protected $translationForeignKey = 'subcategory_id';

    protected $translationModel = SubcategoriesTranslationModel::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subcategories';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'order', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(ProductModel::class, 'product_subcategories', 'subcategory_id', 'product_id')
            // ->orderByPivot('order') //Ordenamento fica no produto agora
            ->orderBy('products.order')
            ->withTimestamps()
            ->has('translation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productSubcategories()
    {
        return $this->hasMany(ProductSubcategoryModel::class, 'subcategory_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faq()
    {
        return $this->hasMany(SubcategoriesFaqModel::class, 'subcategory_id')->orderBy('order');
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
     *
     */
    public function buildSortQuery()
    {
        return static::query()->where('category_id', $this->category_id);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Database\Factories\SubcategoryFactory::new();
    }

    /**
     * url
     */
    public function getUrlAttribute()
    {
        return routeLocale('frontend.products.subcategory', [
            'slugCategory' => @$this->category->slug ?: '-',
            'slugSubcategory' => @$this->slug ?: '-',
        ]);
    }
}
