<?php
namespace Omega;

use Illuminate\Database\Eloquent\Model;

class CourseClass extends Model
{
    protected $fillable = [
        'trimester_id', 'course_number', 'class_number', 'teacher_id', 'location', 'score_a_percent'
    ];

    public function trimester()
    {
        return $this->belongsTo('Omega\Trimester');
    }

    public function course()
    {
        return $this->belongsTo('Omega\Course', 'course_number');
    }

    public function teacher()
    {
        return $this->belongsTo('Omega\User', 'teacher_id');
    }

    public function enrollments()
    {
        return $this->hasMany('Omega\CourseEnrollment');
    }

    public function timetable()
    {
        return $this->hasMany('Omega\CourseClassTime');
    }
}
