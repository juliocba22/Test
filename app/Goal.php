<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Goal
 *
 * @property int $id
 * @property int $course_id
 * @property string $goal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Goal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Goal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Goal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Goal whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Goal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Goal whereGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Goal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Goal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Goal extends Model
{
    protected $fillable = ['course_id', 'goal'];

    public function course () {
    	return $this->belongsTo(Course::class);
    }
}
