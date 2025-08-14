<?php

namespace Products\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * @property integer $id
 * @property integer $model_id
 * @property integer $group_id
 * @property Model $model
 * @property Group $group
 */
class ModelGroupModel extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $connection = 'products'; // conexão com o banco de stara br

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'model_groups';

    /**
     * @var array
     */
    protected $fillable = ['model_id', 'group_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function model()
    {
        return $this->belongsTo('App\Domains\Model\Models\ModelModel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo('App\Domains\Group\Models\GroupModel');
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
