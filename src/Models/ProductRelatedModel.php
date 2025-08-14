<?php

namespace Products\Models;

use Products\Models\ProductModel;
use BaseCms\Models\BaseModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property integer $id
 * @property integer $product_id
 * @property integer $related_id
 * @property integer $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Product $product
 */
class ProductRelatedModel extends Model
{
    use HasFactory;
    use LogsActivity;

    use SortableTrait;
    use BaseModelTrait;

    protected $connection = 'products'; // conexão com o banco de stara br

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_relateds';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'related_id', 'order', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function related()
    {
        return $this->belongsTo(ProductModel::class, 'related_id');
    }

    /**
     *
     */
    public function buildSortQuery()
    {
        return static::query()->where('product_id', $this->product_id);
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
