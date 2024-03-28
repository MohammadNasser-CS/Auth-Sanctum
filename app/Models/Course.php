<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $primaryKey = 'course_id';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
    public $incrementing = false;
    // ========== relations =====================
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_course', 'course_id', 'student_id');
    }
    public function studentCourses()
    {
        return $this->hasMany(StudentCourse::class, 'course_id', 'course_id');
    }
}
