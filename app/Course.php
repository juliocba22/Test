<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Course
 *
 * @property int $id
 * @property int $teacher_id
 * @property int $category_id
 * @property int $level_id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property string|null $picture
 * @property string $status
 * @property int $previous_approved
 * @property int $previous_rejected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePreviousApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePreviousRejected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Course extends Model
{
    use SoftDeletes;

	protected $fillable = ['teacher_id', 'name', 'description', 'picture', 'level_id', 'category_id', 'status'];

	const PUBLISHED = 1;
	const PENDING = 2;
	const REJECTED = 3;

	protected $withCount = ['reviews', 'students'];

	public static function boot () {
		parent::boot();

		static::saving(function(Course $course) {
			if( ! \App::runningInConsole() ) {
				$course->slug = Str::slug($course->name, "-");
			}
		});

		static::saved(function (Course $course) {
			if ( ! \App::runningInConsole()) {
				if ( request('requirements')) {
					foreach (request('requirements') as $key => $requirement_input) {
						if ($requirement_input) {
							Requirement::updateOrCreate(['id' => request('requirement_id'. $key)], [
								'course_id' => $course->id,
								'requirement' => $requirement_input
							]);
						}
					}
				}

				if(request('goals')) {
					foreach(request('goals') as $key => $goal_input) {
						if( $goal_input) {
							Goal::updateOrCreate(['id' => request('goal_id'.$key)], [
								'course_id' => $course->id,
								'goal' => $goal_input
							]);
						}
					}
				}
			}
		});
	}

	public function pathAttachment () {
		return "/storage/courses/" . $this->picture;
	}

	public function getRouteKeyName() {
		return 'slug';
	}

	public function category () {
		return $this->belongsTo(Category::class)->select('id', 'name');
	}

	public function goals () {
		return $this->hasMany(Goal::class)->select('id', 'course_id', 'goal');
	}

	public function level () {
		return $this->belongsTo(Level::class)->select('id', 'name');
	}

	public function reviews () {
		return $this->hasMany(Review::class)->select('id', 'user_id', 'course_id', 'rating', 'comment', 'created_at');
	}

	public function requirements () {
		return $this->hasMany(Requirement::class)->select('id', 'course_id', 'requirement');
	}

	public function students () {
		return $this->belongsToMany(Student::class);
	}

	public function teacher () {
		return $this->belongsTo(Teacher::class);
	}

	public function getCustomRatingAttribute () {
		return $this->reviews->avg('rating');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 */
	public function relatedCourses () {
		return Course::with('reviews')->whereCategoryId($this->category->id)
			->where('id', '!=', $this->id)
			->latest()
			->limit(6)
			->get();
	}

}
