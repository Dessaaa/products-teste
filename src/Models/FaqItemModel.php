<?php

namespace Products\Models;

use Products\Models\FaqItemsTranslationModel;
use Products\Models\FaqTabModel;
use App\Models\Traits\BaseTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use BaseCms\Models\BaseModelTrait;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property integer $id
 * @property integer $faq_tab_id
 * @property string $question
 * @property string $answer
 * @property integer $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property FaqTab $faqTab
 */
class FaqItemModel extends Model implements Sortable
{
    use HasFactory;
    use LogsActivity;

    use SortableTrait;
    use BaseModelTrait;

    /**
     * Translate
     */
    use BaseTranslation;
    use Translatable;

    protected $connection = 'products'; // conexão com o banco de stara br

    public $translatedAttributes = ['question', 'answer'];

    protected $translationForeignKey = 'faq_item_id';

    protected $translationModel = FaqItemsTranslationModel::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq_items';

    /**
     * @var array
     */
    protected $fillable = ['faq_tab_id', 'order', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faqTab()
    {
        return $this->belongsTo(FaqTabModel::class, 'faq_tab_id')->orderBy('order');
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
        return \Database\Factories\FaqItemFactory::new();
    }

    /**
     *
     */
    public function buildSortQuery()
    {
        return static::query()->where('faq_tab_id', $this->faq_tab_id);
    }
}
