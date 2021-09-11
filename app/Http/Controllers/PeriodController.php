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
            "level" => "required|integer",
            "department" => "required|string",
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

        $checkp = Period::where("day", $request->day)->where("level", $request->level)->where("department", $request->department)->first();
        // $checkpde = Peroid::where("department")->coun
        // return $checkp;
        if ($checkp != null) {
            return response(["message" => "Timetable for the day and level already exist", "status" => "error"], 200);
        }
        $period = Period::create([
            "day" => $request->day,
            "department" => $request->department,
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
    public function gettimetable(Request $request) {
        $request->validate([
            "department" => "required|string",
            "level" => "required|integer"
        ]);
        $period = period::where("level", $request->level)->where("department", $request->department)->get();
        foreach($period as $pe) {
            $pe->x78 = $pe["7-8"];
            $pe->x89 = $pe["8-9"];
            $pe->x910 = $pe["9-10"];
            $pe->x1011 = $pe["10-11"];
            $pe->x1112 = $pe["11-12"];
            $pe->x1201 = $pe["12-01"];
            $pe->x0102 = $pe["01-02"];
            $pe->x0203 = $pe["02-03"];
            $pe->x0304 = $pe["03-04"];
            $pe->x0405 = $pe["04-05"];
            // "7-8" => $request->x78,
            // "8-9" => $request->x89,
            // "9-10" => $request->x910,
            // "10-11" => $request->x1011,
            // "11-12" => $request->x1112,
            // "12-01" => $request->x1201,
            // "01-02" => $request->x0102,
            // "02-03" => $request->x0203,
            // "03-04" => $request->x0304,
            // "04-05" => $request->x0405
        }
        return response(["message" => "fetched successfully", "status" => "success", "periods" => $period], 200);
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
