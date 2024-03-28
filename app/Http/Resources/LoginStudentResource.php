<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class LoginStudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {

        return [
            "token" => $request->token, // Accessing token directly from $this
            "student" => [
                "std_id" => $request->std_id, // Accessing std_id from $student
                "name" => $request->name, // Accessing name from $student
                "email" => $request->email, // Accessing email from $student
                // Avoid hashing the password in the response
                // "password" => Hash::make($student->password),
            ],
        ];
    }
}
