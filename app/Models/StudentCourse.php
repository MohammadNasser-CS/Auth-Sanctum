<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = 'student_course';
    // protected $primaryKey = ['student_id', 'course_id'];
    // public $incrementing = false;
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }
}
