<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LectureController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }

        Lecture::create([
            'name' => $request->input('name'),
            'subject_id' => $request->input('subject_id'),
        ]);

        return redirect()->back()->with(['success' => __('messages.lecture_created')]);
    }

    public function destroy($lecture_id)
    {
        Lecture::findOrFail($lecture_id)->delete();
        return redirect()->back()->with(['success' => __('messages.lecture_deleted')]);
    }
}
