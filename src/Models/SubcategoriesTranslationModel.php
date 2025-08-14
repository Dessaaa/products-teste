<?php

namespace App\Domains\SubcategoriesTranslation\Models;

use App\Domains\Subcategory\Models\SubcategoryModel;
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
 * @property integer $subcategory_id
 * @property string $name
 * @property string $slug
 * @property string $thumb
 * @property string $hero_title
 * @property string $hero_image
 * @property string $hero_image_mobile
 * @property string $hero_align
 * @property string $title_right
 * @property string $text_right
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Locale $locale
 * @property Subcategory $subcategory
 */
class SubcategoriesTranslationModel extends Model
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
    protected $table = 'subcategories_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'locale',
        'subcategory_id',
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
        'created_at',
        'updated_at',
    ];

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
    public function subcategory()
    {
        return $this->belongsTo(SubcategoryModel::class, 'subcategory_id');
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
        return \Database\Factories\SubcategoryTranslationFactory::new();
    }
}
