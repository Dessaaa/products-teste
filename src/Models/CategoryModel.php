<?php

namespace Products\Models;

use Products\Models\CategoriesFaqModel;
use Products\Models\CategoriesTranslationModel;
use Products\Models\ProductModel;
use Products\Models\ProductCategoryModel;
use Products\Models\SubcategoryModel;
use App\Models\Traits\BaseSeoTrait;
use App\Models\Traits\BaseTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use BaseCms\Models\BaseModelTrait;
use BaseCms\Models\LocaleModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property integer $id
 * @property string $locale
 * @property string $type
 * @property string $slug
 * @property string $name
 * @property string $hero_title
 * @property string $hero_image
 * @property string $hero_image_mobile
 * @property string $hero_align
 * @property string $title_left
 * @property string $title_right
 * @property string $text_right
 * @property bool $disabled_url
 * @property integer $order
 * @property mixed $deleted_at
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Locale $locale
 * @property ProductCategory[] $productCategories
 * @property Subcategory[] $subcategories
 */
class CategoryModel extends Model implements Sortable
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

    protected $translationForeignKey = 'category_id';

    protected $translationModel = CategoriesTranslationModel::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $fillable = ['type', 'slug', 'disabled_url', 'name', 'order', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(ProductModel::class, 'product_categories', 'category_id', 'product_id')
            // ->orderByPivot('order') //Ordenamento fica no produto agora
            ->orderBy('products.order')
            ->withTimestamps()
            ->has('translation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productCategories()
    {
        return $this->hasMany(ProductCategoryModel::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategories()
    {
        return $this->hasMany(SubcategoryModel::class, 'category_id')->orderBy('order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faq()
    {
        return $this->hasMany(CategoriesFaqModel::class, 'category_id')->orderBy('order');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Database\Factories\CategoryFactory::new();
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
     * url
     */
    public function getUrlAttribute()
    {
        if ($this->disabled_url) {
            return null;
        }

        return routeLocale('frontend.products.category', ['slugCategory' => @$this->slug ?: '-']);
    }
}
