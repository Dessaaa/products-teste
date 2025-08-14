<?php

namespace Products\Models;

use Products\Models\ProductFeaturesTranslationModel;
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
 * @property integer $product_id
 * @property string $image
 * @property integer $order
 * @property mixed $deleted_at
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Product $product
 * @property ProductFeaturesTranslation[] $productFeaturesTranslations
 */
class ProductFeatureModel extends Model implements Sortable
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

    protected $connection = 'products'; // conexão com o banco de stara br

    public $translatedAttributes = ['title', 'text'];

    protected $translationForeignKey = 'product_feature_id';

    protected $translationModel = ProductFeaturesTranslationModel::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_features';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'image', 'order', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('Products\Models\ProductModel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productFeaturesTranslations()
    {
        return $this->hasMany('Products\Models\ProductFeaturesTranslationModel');
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
        return static::query()->where('product_id', $this->product_id);
    }
}
