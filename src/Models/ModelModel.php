<?php

namespace Products\Models;

use Products\Models\GroupModel;
use Products\Models\ModelGroupModel;
use Products\Models\ModelsTranslationModel;
use Products\Models\ModelTechspecModel;
use Products\Models\ProductModel;
use Products\Models\TechspecModel;
use App\Models\Traits\BaseTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property string $image
 * @property string $thumb
 * @property string $file_360
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Product $product
 */
class ModelModel extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * Translate
     */
    use BaseTranslation;
    use Translatable;

    protected $connection = 'products'; // conexão com o banco de stara br

    public $translatedAttributes = ['name', 'name3d'];

    protected $translationForeignKey = 'model_id';

    protected $translationModel = ModelsTranslationModel::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'models';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'file_360', 'thumb', 'image', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modelTechspec()
    {
        return $this->hasMany(ModelTechspecModel::class, 'model_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function techspecs()
    {
        return $this->belongsToMany(TechspecModel::class, 'model_techspecs', 'model_id', 'techspec_id')
            ->using(ModelTechspecModel::class)
            // ->withPivot('order') //Order foi para o TechspecModel
            // ->orderByPivot('order')
            ->withTimestamps()
            ->orderBy('order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modelGroups()
    {
        return $this->hasMany(ModelGroupModel::class, 'model_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups()
    {
        return $this->belongsToMany(GroupModel::class, 'model_groups', 'model_id', 'group_id')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
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
        return \Database\Factories\ModelFactory::new();
    }
}
