<?php

namespace App\Domains\ProductDiff\Models;

use App\Domains\ProductDiffsTranslation\Models\ProductDiffsTranslationModel;
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
 * @property string $type
 * @property integer $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $deleted_at
 * @property Product $product
 * @property ProductDiffsTranslation[] $productDiffsTranslations
 */
class ProductDiffModel extends Model implements Sortable
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

    protected $translationForeignKey = 'product_diffs_id';

    protected $translationModel = ProductDiffsTranslationModel::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_diffs';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'image', 'type', 'order', 'created_at', 'updated_at', 'deleted_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(ProductModel::class, 'product_diffs', 'product_diffs_id', 'product_id')
            ->orderByPivot('order')
            ->withTimestamps()
            ->has('translation');
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
        return \Database\Factories\ProductDiffFactory::new();
    }

    /**
     *
     */
    public function buildSortQuery()
    {
        return static::query()->where('product_id', $this->product_id);
    }
}
