<?php

namespace Products\Models;

use Products\Models\ProductModel;
use Products\Models\SolutionModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property integer $id
 * @property integer $solution_id
 * @property integer $product_id
 * @property string $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Product $product
 */
class ProductSolutionModel extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $connection = 'products'; // conexão com o banco de stara br

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_solutions';

    /**
     * @var array
     */
    protected $fillable = ['solution_id', 'product_id', 'order', 'created_at', 'updated_at'];

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
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Database\Factories\ProductSolutionFactory::new();
    }
}
