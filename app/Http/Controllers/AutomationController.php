<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AutomationController extends Controller
{
    public function processCourse(Request $rq) {
        $validator = Validator::make($rq->all(), [
            'name' => ['required'],
            'trainer_organization' => ['required'],
        ]);
        if ($validator->fails()) return response()->json([
            "status" => "error",
            "message" => $validator->errors()->first(),
        ], 400);

        // process industries
        // $industries = Industry::whereIn("name", $rq->industries)
        //     ->get()
        //     ->pluck("id");

        // incoming data cleanup
        $data = array_map(
            function ($v) {
                if (is_array($v)) {
                    $v = array_filter($v);
                    return (empty($v)) ? null : $v;
                }
                return $v;
            },
            $rq->all()
        );
        if ($data["trainer_name"] == $data["trainer_organization"]) $data["trainer_name"] = null;

        $course = Course::where("name", $data["name"])
            ->where("trainer_organization", $data["trainer_organization"])
            ->first();

        if ($course) {
            $course->update($data);
            // $course->industries()->sync($industries);
            return response()->json([
                "status" => "course updated",
                "course" => $course,
            ]);
        }

        $course = Course::create(array_merge($data, [
            "visible" => 2,
        ]));
        // $course->industries()->sync($industries);

        return response()->json([
            "status" => "course created",
            "course" => $course,
        ], 201);
    }
}
