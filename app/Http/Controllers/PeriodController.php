<?php

namespace App\Http\Controllers;

use App\Models\period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
  
    public function createperiod(Request $request)
    {
        $request->validate([
            "day" => "required|string",
            "level" => "required|string",
            "x78" => "required|string",
            "x89" => "required|string",
            "x910" => "required|string",
            "x1011" => "required|string",
            "x1112" => "required|string",
            "x1201" => "required|string",
            "x0102" => "required|string",
            "x0203" => "required|string",
            "x0304" => "required|string",
            "x0405" => "required|string"
        ]);
        // return $request->day. " ".$request->level;

        $checkp = Period::where("day", $request->day)->where("level", $request->level)->first();
        // return $checkp;
        if ($checkp != null) {
            return response(["message" => "timetable for the day and level already exist", "status" => "error"], 200);
        }
        $period = Period::create([
            "day" => $request->day,
            "level" => $request->level,
            "7-8" => $request->x78,
            "8-9" => $request->x89,
            "9-10" => $request->x910,
            "10-11" => $request->x1011,
            "11-12" => $request->x1112,
            "12-01" => $request->x1201,
            "01-02" => $request->x0102,
            "02-03" => $request->x0203,
            "03-04" => $request->x0304,
            "04-05" => $request->x0405
        ]);
        return response(["message" => "created successfully." , "period" => $period, "status" => "success"], 200);
    }

    public function editperiod(Request $request) {
        $request->validate([
            "id" => "required|integer",
            "day" => "required|string",
            "level" => "required|string",
            "x78" => "required|string",
            "x89" => "required|string",
            "x910" => "required|string",
            "x1011" => "required|string",
            "x1112" => "required|string",
            "x1201" => "required|string",
            "x0102" => "required|string",
            "x0203" => "required|string",
            "x0304" => "required|string",
            "x0405" => "required|string"
        ]);
        // return $request->day. " ".$request->level;

        $checkp = Period::where("day", $request->day)->where("level", $request->level)->first();
        // return $checkp;
        if ($checkp != null) {
            return response(["message" => "timetable for the day and level already exist", "status" => "error"], 200);
        }
        $period = Period::where("id", $request->id)->first();
        $period->update([
            "day" => $request->day,
            "level" => $request->level,
            "7-8" => $request->x78,
            "8-9" => $request->x89,
            "9-10" => $request->x910,
            "10-11" => $request->x1011,
            "11-12" => $request->x1112,
            "12-01" => $request->x1201,
            "01-02" => $request->x0102,
            "02-03" => $request->x0203,
            "03-04" => $request->x0304,
            "04-05" => $request->x0405
        ]);
        $period->save();
        return response(["message" => "created successfully." , "period" => $period, "status" => "success"], 200);
    }
  
}
