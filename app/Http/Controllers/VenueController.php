<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function createvenue (Request $request) {
        $request->validate([
            "name" => "required|string",
            "description" => "required|string"
        ]);
        $venue = Venue::create([
            "name" => $request->name,
            "description" => $request->description
        ]);
        return response([
            "message" => "Venue created successfully.", 
            "status" => "success", 
            "veune" => $venue
        ], 200);
    }

    public function all (Request $request) {
        $request->validate([
            "page_number" => "required|integer"
        ]);
        $venues = Venue::paginate($request->page_number);
        return response(["message" => "Venue retrive successfully.", "venue" => $venues], 200);
    }

    public function venuedelete (Request $request) {
        $request->validate([
            "id" => "required|integer"
        ]);
        $venue = Venue::where("id", $request->id)->first();
        if ($venue == null) {
            return response(["message" => "Venue does'nt exist.", "status" => "error"], 200);
        }
        return response(["message" => "Venue deleted successfully.", "status" => "success"], 200);
    }
}
