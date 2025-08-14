<?php

namespace Products\Models;

use Products\Models\ModelTechspecModel;
use BaseCms\Models\LocaleModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * @property integer $id
 * @property string $locale
 * @property integer $model_techspec_id
 * @property string $value
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Locale $locale
 * @property ModelTechspec $modelTechspec
 */
class ModelTechspecsTranslationModel extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $connection = 'products'; // conexão com o banco de stara br

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'model_techspecs_translations';

    /**
     * @var array
     */
    protected $fillable = ['locale', 'model_techspec_id', 'value', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function locale()
    {
        return $this->belongsTo(LocaleModel::class, 'locale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modelTechspec()
    {
        return $this->belongsTo(ModelTechspecModel::class, 'model_techspec_id');
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
        return \Database\Factories\ModelTechspecTranslationFactory::new();
    }
}
