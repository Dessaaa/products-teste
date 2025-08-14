<?php

namespace App\Domains\ProductsFaq\Models;

use App\Models\Traits\BaseTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use BaseCms\Models\BaseModelTrait;

/**
 * @property integer $id
 * @property integer $product_id
 * @property integer $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Product $product
 * @property ProductsFaqTranslation[] $productsFaqTranslations
 */
class ProductsFaqModel extends Model implements Sortable
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
    protected $table = 'products_faq';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'title', 'text', 'order', 'created_at', 'updated_at'];

    /**
     * Translate
     */
    use BaseTranslation;
    use Translatable;

    public $translatedAttributes = ['title', 'text'];

    protected $translationForeignKey = 'products_faq_id';

    protected $translationModel = \App\Domains\ProductsFaqTranslation\Models\ProductsFaqTranslationModel::class;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Domains\Product\Models\ProductModel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productsFaqTranslations()
    {
        return $this->hasMany('App\Domains\ProductsFaqTranslation\Models\ProductsFaqTranslationModel');
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
