<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'student' =>  $this['student'],
            'courses' => $this['courses'],
        ];
    }
}
/*
[
                'student_id' => (string)$this->student->std_id,
                'Student name' => $this->student->name,
                'Student email' => $this->student->email
            ],
*/
