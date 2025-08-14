<?php

namespace App\Domains\SubcategoriesFaq\Models;



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
 * @property integer $subcategory_id
 * @property integer $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Subcategory $subcategory
 * @property SubcategoriesFaqTranslation[] $subcategoriesFaqTranslations
 */
class SubcategoriesFaqModel extends Model implements Sortable
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
    protected $table = 'subcategories_faq';

    /**
     * @var array
     */
    protected $fillable = ['subcategory_id', 'title', 'text', 'order', 'created_at', 'updated_at'];

    /**
     * Translate
     */
    use BaseTranslation;
    use Translatable;

    public $translatedAttributes = ['title', 'text'];

    protected $translationForeignKey = 'subcategories_faq_id';

    protected $translationModel = \App\Domains\SubcategoriesFaqTranslation\Models\SubcategoriesFaqTranslationModel::class;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Domains\Subcategory\Models\SubcategoryModel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategoriesFaqTranslations()
    {
        return $this->hasMany('App\Domains\SubcategoriesFaqTranslation\Models\SubcategoriesFaqTranslationModel');
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
