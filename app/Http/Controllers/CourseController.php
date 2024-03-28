<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\CoursesResource;
use App\Http\Resources\StoreCourseResource;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $std_id = Auth::user()->std_id;
        $student_info = Student::where('std_id', $std_id)->get();
        $crs_ids = StudentCourse::where('student_id', $std_id)->pluck('course_id');
        $crs_data = StudentCourse::where('student_id', $std_id)->get();
        // return response($crs_data->status);
        $courses = Course::whereIn('course_id', $crs_ids)->get();
        // $courses = Course::with('studentCourses');
        $res = [
            'student' => $student_info,
            'courses' =>  $courses,
            // 'course_status' => $crs_data->status,

        ];
        return (new CoursesResource($res))->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $course = Course::create([
            'course_id' => $request->course_id,
            'name' => $request->name,
            'weight' => $request->weight,
        ]);
        $student_course = StudentCourse::create([
            'student_id' => Auth::user()->std_id,
            'course_id' => $request->course_id,
            'status' => $request->status,
        ]);
        $res = [
            'message' => 'The Course Added Successfully',
            'course' => $course,
            'student_course' =>  $student_course,
            // 'course_status' => $crs_data->status,
        ];
        return new StoreCourseResource($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        // new CoursesResource($course)
        // return response()->json('test');
        return $this->isNotAuthorized($course) ? $this->isNotAuthorized($course) : response()->json($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id)
    {
        // $request->validate([
        //     'status' => 'required|in:success,failed', // Add other validation rules if needed
        // ]);

        $course = Course::where('course_id', $course_id)->firstOrFail();
        $std_id = Auth::user()->std_id;
        $student_course = StudentCourse::where('course_id', $course_id)->firstOrFail();
        $isEnrolled = $course->students()->where('std_id', $std_id)->exists();
        if (!$isEnrolled) {
            return response()->json('You are not authorized to make this request', 403);
        }
        $course->update([
            'course_id' => $course_id,
            'name' => $request->name,
            'weight' => $request->weight,
        ]);
        // $student_course->update([
        //     'status' => $request->status,
        // ]);
        $res = [
            'message' => 'The Course Information Updated Successfully',
            'course' => $course,
            'student_course' =>  $student_course,
            // 'course_status' => $crs_data->status,
        ];
        return new StoreCourseResource($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        return $this->isNotAuthorized($course) ? $this->isNotAuthorized($course) : $course->delete();
    }

    private function isNotAuthorized($course)
    {
        // $isExist = Course::where('course_id', $course->course_id)->exists();
        // if (!$isExist) {
        //     return response()->json('No Such Course', 404);
        // }
        $std_id = Auth::user()->std_id;
        $isEnrolled = $course->students()->where('std_id', $std_id)->exists();
        if (!$isEnrolled) {
            return response()->json('You are not authorized to make this request', 403);
        }
    }
}
