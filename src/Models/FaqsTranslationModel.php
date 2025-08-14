<?php

namespace App\Domains\FaqsTranslation\Models;

use App\Domains\Faq\Models\FaqModel;
use BaseCms\Models\LocaleModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * @property integer $id
 * @property string $locale
 * @property integer $faq_id
 * @property string $title
 * @property string $text
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Faq $faq
 * @property Locale $locale
 */
class FaqsTranslationModel extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $connection = 'products'; // conexão com o banco de stara br

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faqs_translations';

    /**
     * @var array
     */
    protected $fillable = ['locale', 'faq_id', 'title', 'text', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faq()
    {
        return $this->belongsTo(FaqModel::class, 'faq_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function locale()
    {
        return $this->belongsTo(LocaleModel::class, 'locale');
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
        return \Database\Factories\FaqTranslationFactory::new();
    }
}
