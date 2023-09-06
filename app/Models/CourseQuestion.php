<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;
    // ,HasUuids
    protected $fillable = ['question', 'course_id', 'uuid'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function answers()
    {
        return $this->belongsToMany(CourseAnswer::class, 'course_answer_questions')
            ->withPivot('status');
    }
    public function reference()
    {
        return $this->morphOne(Reference::class, 'referenceable');
    }
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoriteble');
    }
}
