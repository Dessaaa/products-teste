<?php

namespace Products\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BaseTranslation;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use BaseCms\Models\BaseModelTrait;

/**
 * @property integer $id
 * @property integer $category_id
 * @property integer $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Category $category
 * @property CategoriesFaqTranslation[] $categoriesFaqTranslations
 */
class CategoriesFaqModel extends Model implements Sortable
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
    protected $table = 'categories_faq';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'title', 'text', 'order', 'created_at', 'updated_at'];

    /**
     * Translate
     */
    use BaseTranslation;
    use Translatable;

    public $translatedAttributes = ['title', 'text'];

    protected $translationForeignKey = 'categories_faq_id';

    protected $translationModel = CategoriesFaqTranslationModel::class;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Products\Models\CategoryModel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoriesFaqTranslations()
    {
        return $this->hasMany('Products\Models\CategoriesFaqTranslationModel');
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
