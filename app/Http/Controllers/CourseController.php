<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
   
    public function createcourses(Request $request)
    {
        $request->validate([
            "course_code" => "required|string|unique:courses",
            "description" => "required|string"
        ]);
        $courses = Course::create([
            "course_code" => $request->course_code,
            "description" => $request->description
        ]);
        return response(["message" => "Courses registered successfully.", "courses" => $courses, "status" => "success"], 200);
    }
    public function single(Request $request) {
        $request->validate([
            "id" => "required|integer"
        ]);
        $courses = Course::where("id", $request->id)->first();
        if ($courses == null) {
            return response(["message" => "Course doesn't exist.", "status" => "error"], 200);
        }
        return response(["message" => "Courses fetched successfully.", "courses" => $courses, "status" => "success"], 200);
    }

    public function all(Request $request) {
        $request->validate([
            "page_number" => "required|integer"
        ]);
        $courses = Course::orderBy('id', 'DESC')->paginate($request->page_number);
        return response(["message" => "Courses fetched","courses" => $courses,"status" => "success"], 200);
    }
    public function remove_delete(Request $request) {
        $request->validate([
            "id" => "required|integer"
        ]);
        $courses = Course::where("id", $request->id)->first();
        if ($courses == null) {
            return response(["message" => "Course doesn't exist.", "status" => "error"], 200);
        }
        $courses->delete();
        return response(["message" => "Courses deleted successfully.", "courses" => $courses, "status" => "success"], 200);
    }

    public function editcourse(Request $request) {
        $request->validate([
            "id" => "required|integer",
            "course_code" => "required|string",
            "description" => "required|string"
        ]);
        $checkcourse = Course::where("course_code", $request->course_code)->where("id","!=",$request->id)->first();
        if ($checkcourse != null) {
            return response(["message" => "Course Code already exist.", "status" => "error"], 200);
        }
     
        $courses = Course::where("id", $request->id)->first();
        if ($courses == null) {
            return response(["message" => "Course doesn't exist.", "status" => "error"], 200);
        }
        $courses->update([
            "course_code" => $request->course_code,
            "description" => $request->description
        ]);
        $courses->save();
        return response(["message" => "Courses registered successfully.", "courses" => $courses, "status" => "success"], 200);
    }

  
}
