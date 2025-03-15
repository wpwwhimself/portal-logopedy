<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialModelActionsController extends Model
{
    public function morphCourseToUniversity(int $id) {
        $course = Course::find($id);

        $insert_data = $course->toArray();
        $insert_data["name"] = $insert_data["trainer_organization"];

        $university = University::create($insert_data);

        $course->delete();

        return redirect()->route('admin-edit-model', ['model' => 'universities', 'id' => $university->id])->with("success", "Kurs został przekształcony");
    }
}
