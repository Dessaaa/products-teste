<?php

namespace App\Domains\CategoriesFaqTranslation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


/**
 * @property integer $id
 * @property string $locale
 * @property integer $categories_faq_id
 * @property string $title
 * @property string $text
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property CategoriesFaq $categoriesFaq
 * @property Locale $locale
 */
class CategoriesFaqTranslationModel extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $connection = 'products'; // conexão com o banco de stara br

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'categories_faq_translations';

    /**
     * @var array
     */
    protected $fillable = ['locale', 'categories_faq_id', 'title', 'text', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoriesFaq()
    {
        return $this->belongsTo('App\Domains\CategoriesFaq\Models\CategoriesFaqModel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function locale()
    {
        return $this->belongsTo('App\Domains\Locale\Models\LocaleModel', 'locale');
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
