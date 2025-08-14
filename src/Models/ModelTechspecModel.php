<?php

namespace App\Domains\ModelTechspec\Models;

use App\Domains\ModelTechspecsTranslation\Models\ModelTechspecsTranslationModel;
use App\Domains\Product\Models\ProductModel;
use App\Domains\Techspec\Models\TechspecModel;
use App\Models\Traits\BaseTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use BaseCms\Models\BaseModelTrait;
use Illuminate\Database\Eloquent\Relations\Concerns\AsPivot;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property integer $id
 * @property integer $model_id
 * @property integer $techspec_id
 * @property string $value
 * @property integer $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Product $product
 * @property Techspec $techspec
 */
class ModelTechspecModel extends Model implements Sortable
{
    use HasFactory;
    use LogsActivity;

    use SortableTrait;
    use BaseModelTrait;

    /**
     * Translate
     */
    use BaseTranslation;
    use Translatable;

    use AsPivot;

    protected $connection = 'products'; // conexão com o banco de stara br

    public $translatedAttributes = ['value'];

    protected $translationForeignKey = 'model_techspec_id';

    protected $translationModel = ModelTechspecsTranslationModel::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'model_techspecs';

    /**
     * @var array
     */
    protected $fillable = ['model_id', 'techspec_id', 'order', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'model_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function techspec()
    {
        return $this->belongsTo(TechspecModel::class, 'techspec_id');
    }

    /**
     *
     */
    public function buildSortQuery()
    {
        return static::query()->where('model_id', $this->model_id);
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
        return \Database\Factories\ModelTechspecFactory::new();
    }
}
