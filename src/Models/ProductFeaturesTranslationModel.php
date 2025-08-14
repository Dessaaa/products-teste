<?php

namespace Products\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * @property integer $id
 * @property string $locale
 * @property integer $product_feature_id
 * @property string $title
 * @property string $text
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Locale $locale
 * @property ProductFeature $productFeature
 */
class ProductFeaturesTranslationModel extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $connection = 'products'; // conexão com o banco de stara br

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_features_translations';

    /**
     * @var array
     */
    protected $fillable = ['locale', 'product_feature_id', 'title', 'text', 'created_at', 'updated_at'];

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
    public function productFeature()
    {
        return $this->belongsTo('Products\Models\ProductFeatureModel');
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
