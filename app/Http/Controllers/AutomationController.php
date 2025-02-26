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

        $course = Course::where("name", $rq->name)
            ->where("trainer_organization", $rq->trainer_organization)
            ->first();

        if ($course) {
            $course->update($rq->all());
            // $course->industries()->sync($industries);
            return response()->json([
                "status" => "course updated",
                "course" => $course,
            ]);
        }

        $course = Course::create(array_merge($rq->all(), [
            "visible" => 2,
        ]));
        // $course->industries()->sync($industries);

        return response()->json([
            "status" => "course created",
            "course" => $course,
        ], 201);
    }
}
