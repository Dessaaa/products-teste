<?php

namespace Products\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * @property integer $id
 * @property string $locale
 * @property integer $product_diffs_id
 * @property string $title
 * @property string $text
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Locale $locale
 * @property ProductDiff $productDiff
 */
class ProductDiffsTranslationModel extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $connection = 'products'; // conexão com o banco de stara br

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_diffs_translations';

    /**
     * @var array
     */
    protected $fillable = ['locale', 'product_diffs_id', 'title', 'text', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function locale()
    {
        return $this->belongsTo('App\Domains\Locale\Models\LocaleModel', 'locale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productDiff()
    {
        return $this->belongsTo('Products\Models\ProductDiffModel', 'product_diffs_id');
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
