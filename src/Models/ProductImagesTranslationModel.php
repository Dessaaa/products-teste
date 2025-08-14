<?php

namespace App\Domains\ProductImagesTranslation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


/**
 * @property integer $id
 * @property string $locale
 * @property integer $product_images_id
 * @property string $image
 * @property string $video
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Locale $locale
 * @property ProductImage $productImage
 */
class ProductImagesTranslationModel extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $connection = 'products'; // conexão com o banco de stara br

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'product_images_translations';

    /**
     * @var array
     */
    protected $fillable = ['locale', 'product_images_id', 'image', 'image_seo', 'video', 'created_at', 'updated_at'];

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
    public function productImage()
    {
        return $this->belongsTo('App\Domains\ProductImage\Models\ProductImageModel', 'product_images_id');
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
