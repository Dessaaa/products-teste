<?php

namespace Products\Models;

use Products\Models\ProductModel;
use Products\Models\SubcategoryModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use BaseCms\Models\BaseModelTrait;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property integer $id
 * @property integer $product_id
 * @property integer $subcategory_id
 * @property integer $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Product $product
 * @property Subcategory $subcategory
 */
class ProductSubcategoryModel extends Model implements Sortable
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
    protected $table = 'product_subcategories';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'subcategory_id', 'order', 'created_at', 'updated_at'];

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
    public function subcategory()
    {
        return $this->belongsTo(SubcategoryModel::class, 'subcategory_id');
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
