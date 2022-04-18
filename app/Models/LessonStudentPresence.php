<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LessonStudentPresence
 *
 * @property int $lesson_id
 * @property int $student_id
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudentPresence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudentPresence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudentPresence query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudentPresence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudentPresence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudentPresence whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudentPresence whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudentPresence whereUpdatedAt($value)
 */
class LessonStudentPresence extends Model
{
    public function getTable(): string
    {
        return 'lessons_students_presence';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'lesson_id',
        'student_id',
        'date',
        'lesson_by_count'
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
