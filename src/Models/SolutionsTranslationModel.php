<?php

namespace App\Domains\SolutionsTranslation\Models;

use App\Domains\Solution\Models\SolutionModel;
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
 * @property integer $solution_id
 * @property string $name
 * @property string $slug
 * @property string $hero_title
 * @property string $hero_image
 * @property string $hero_image_mobile
 * @property string $hero_align
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Locale $locale
 * @property Solution $solution
 */
class SolutionsTranslationModel extends Model
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
    protected $table = 'solutions_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'locale',
        'solution_id',
        'name',
        'slug',
        'hero_title',
        'hero_image',
        'hero_image_mobile',
        'hero_align',
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
    public function solution()
    {
        return $this->belongsTo(SolutionModel::class, 'solution_id');
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
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->preventOverwrite()
            ->doNotGenerateSlugsOnUpdate();
    }
}
