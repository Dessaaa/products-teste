<?php

namespace App\Domains\FaqItemsTranslation\Models;

use App\Domains\FaqItem\Models\FaqItemModel;
use BaseCms\Models\LocaleModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * @property integer $id
 * @property string $locale
 * @property integer $faq_item_id
 * @property string $question
 * @property string $answer
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property FaqItem $faqItem
 * @property Locale $locale
 */
class FaqItemsTranslationModel extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $connection = 'products'; // conexão com o banco de stara br

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq_items_translations';

    /**
     * @var array
     */
    protected $fillable = ['locale', 'faq_item_id', 'question', 'answer', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faqItem()
    {
        return $this->belongsTo(FaqItemModel::class, 'faq_item_id');
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
        return \Database\Factories\FaqItemTranslationFactory::new();
    }
}
