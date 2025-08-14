<?php

namespace Products\Models;

use Products\Models\FaqsTranslationModel;
use Products\Models\FaqTabModel;
use App\Models\Traits\BaseTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property integer $id
 * @property string $locale
 * @property string $type
 * @property string $title
 * @property string $text
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property FaqTab[] $faqTabs
 * @property Locale $locale
 */
class FaqModel extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * Translate
     */
    use BaseTranslation;
    use Translatable;

    protected $connection = 'products'; // conexão com o banco de stara br

    public $translatedAttributes = ['title', 'text'];

    protected $translationForeignKey = 'faq_id';

    protected $translationModel = FaqsTranslationModel::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faqs';

    /**
     * @var array
     */
    protected $fillable = ['type', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faqTabs()
    {
        return $this->hasMany(FaqTabModel::class, 'faq_id')->orderBy('order');
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
        return \Database\Factories\FaqFactory::new();
    }
}
