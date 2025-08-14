<?php

namespace App\Domains\FaqTab\Models;

use App\Domains\Faq\Models\FaqModel;
use App\Domains\FaqItem\Models\FaqItemModel;
use App\Domains\FaqTabsTranslation\Models\FaqTabsTranslationModel;
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
 * @property integer $faq_id
 * @property string $title
 * @property integer $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property FaqItem[] $faqItems
 * @property Faq $faq
 */
class FaqTabModel extends Model implements Sortable
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

    public $translatedAttributes = ['title'];

    protected $translationForeignKey = 'faq_tab_id';

    protected $translationModel = FaqTabsTranslationModel::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq_tabs';

    /**
     * @var array
     */
    protected $fillable = ['faq_id', 'order', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faqItems()
    {
        return $this->hasMany(FaqItemModel::class, 'faq_tab_id')->orderBy('order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faq()
    {
        return $this->belongsTo(FaqModel::class, 'faq_id');
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
        return \Database\Factories\FaqTabFactory::new();
    }

    /**
     *
     */
    public function buildSortQuery()
    {
        return static::query()->where('faq_id', $this->faq_id);
    }
}
