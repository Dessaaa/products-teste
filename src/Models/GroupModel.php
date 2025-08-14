<?php

namespace Products\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $name
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $deleted_at
 * @property ModelGroup[] $modelGroups
 * @property TechspecGroup[] $techspecGroups
 */
class GroupModel extends Model
{
    use HasFactory;
    use LogsActivity;

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * @var array
     */
    protected $fillable = ['name', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modelGroups()
    {
        return $this->hasMany('Products\Models\ModelGroupModel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function techspecGroups()
    {
        return $this->hasMany('Products\Models\TechspecGroupModel');
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
