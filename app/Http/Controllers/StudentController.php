<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginStudentRequest;
use App\Http\Requests\RegisterStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(LoginStudentRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            $student = Student::where('email', $request->email)->first();
            $token = $student->createToken('authToken ' . $student->name)->plainTextToken;
            return response()->json([
                'token' => $token,
                'student' => $student,
            ], 200);
            // $res = [
            //     'token' => $token,
            //     "std_id" => $student->std_id,
            //     "name" => $student->name,
            //     "email" => $student->email,
            // ];
            // return (new LoginStudentResource([
            //     $res
            // ]))
            //     ->response()
            //     ->setStatusCode(200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function register(RegisterStudentRequest $request)
    {
        $student =  Student::create([
            'std_id' => $request->std_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        /*
        ======== Optionally log in the user and return a token ============
        $token = $student->createToken('authToken')->plainTextToken;
        return response()->json(['student' => $student, 'token' => $token,], 201);
         */
        return (new StudentResource($request))
            ->response()
            ->setStatusCode(201);
    }
    public function logout(Request $request)
    {
        // Auth::logout();
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
