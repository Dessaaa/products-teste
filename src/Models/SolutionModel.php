<?php

namespace App\Domains\Solution\Models;

use App\Domains\Product\Models\ProductModel;
use App\Domains\SolutionsTranslation\Models\SolutionsTranslationModel;
use App\Models\Traits\BaseSeoTrait;
use App\Models\Traits\BaseTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use BaseCms\Models\BaseModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $type
 * @property integer $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $deleted_at
 * @property SolutionsTranslation[] $solutionsTranslations
 */
class SolutionModel extends Model implements Sortable
{
    use HasFactory;
    use LogsActivity;

    use SortableTrait;
    use BaseModelTrait;

    use SoftDeletes;

    /**
     * Translate
     */
    use BaseTranslation;
    use Translatable;

    use BaseSeoTrait;

    protected $connection = 'products'; // conexão com o banco de stara br

    public $translatedAttributes = ['name', 'slug', 'hero_title', 'hero_image', 'hero_image_mobile', 'hero_align'];

    protected $translationForeignKey = 'solution_id';

    protected $translationModel = SolutionsTranslationModel::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'solutions';

    /**
     * @var array
     */
    protected $fillable = ['type', 'thumb', 'order', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solutionsTranslations()
    {
        return $this->hasMany(SolutionsTranslationModel::class, 'solution_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(ProductModel::class, 'product_solutions', 'solution_id', 'product_id')
            ->orderByPivot('order')
            ->withTimestamps();
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
        return \Database\Factories\SolutionFactory::new();
    }

    /**
     * url
     */
    public function getUrlAttribute()
    {
        return routeLocale('frontend.solutions.solution', ['slug' => @$this->slug ?: '-']);
    }
}
