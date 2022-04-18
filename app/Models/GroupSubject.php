<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\GroupSubject
 *
 * @property int $id
 * @property int $group_id
 * @property int $subject_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubject query()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubject whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubject whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupSubject whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GroupSubject extends Model
{
    public function getTable(): string
    {
        return 'groups_subjects';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'group_id',
        'subject_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'update_at' => 'datetime',
    ];
}
