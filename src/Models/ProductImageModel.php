<?php

namespace App\Domains\ProductImage\Models;

use App\Domains\Product\Models\ProductModel;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BaseTranslation;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use BaseCms\Models\BaseModelTrait;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property integer $id
 * @property integer $product_id
 * @property string $image
 * @property string $video
 * @property integer $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Product $product
 */
class ProductImageModel extends Model implements Sortable
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
    protected $table = 'product_images';

    /**
     * @var array
     */
    protected $fillable = [
        'product_id',
        'image',
        'video',
        'order',
        'created_at',
        'updated_at',
    ];

    /**
     * Translate
     */
    use BaseTranslation;
    use Translatable;

    public $translatedAttributes = ['product_images_id', 'image', 'image_seo', 'video'];

    protected $translationForeignKey = 'product_images_id';

    protected $translationModel = \App\Domains\ProductImagesTranslation\Models\ProductImagesTranslationModel::class;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Database\Factories\ProductImageFactory::new();
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
