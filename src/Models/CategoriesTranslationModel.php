<?php

namespace Products\Models;

use Products\Models\CategoryModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property integer $id
 * @property string $locale
 * @property integer $category_id
 * @property string $name
 * @property string $slug
 * @property string $hero_title
 * @property string $hero_image
 * @property string $hero_image_mobile
 * @property string $hero_align
 * @property string $title_right
 * @property string $text_right
 * @property string $faq_title
 * @property string $faq_text
 * @property Category $category
 * @property Locale $locale
 */
class CategoriesTranslationModel extends Model
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
    protected $table = 'categories_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'locale',
        'category_id',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function locale()
    {
        return $this->belongsTo(LocaleModel::class, 'locale');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Database\Factories\CategoryTranslationFactory::new();
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
}
