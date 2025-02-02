<?php

namespace App\Http\Controllers\Api;

use App\Models\Excuse;
use App\Models\Department;
use App\Models\ExcuseImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Validator;

class ExcuseController extends Controller
{
    public function studentExcuses()
    {
        $excuses = Excuse::with('student', 'images')
        ->where('student_id', Auth::user()->id)
            ->get();

        return sendResponse($excuses, 'Excuses retrieved successfully.');
    }

    public function create()
    {
        $departments = Department::all();
        return sendResponse($departments, 'Departments retrieved successfully.');
    }

    public function show(Excuse $excuse)
    {
        $excuse->load('images');
        return sendResponse($excuse, 'Excuse details retrieved successfully.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string',
            'material' => 'required|in:Medical Report,Medical Examinations,Passport Photo,Other',
            'department' => 'required|exists:departments,name',
            'images.*' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error', $validator->errors());
        }

        try {
            $department = Department::where('name', $request->input('department'))->first();

            $excuse = Excuse::create([
                'reason' => $request->input('reason'),
                'description' => $request->input('description'),
                'material' => $request->input('material'),
                'student_id' => Auth::user()->id,
                'department_id' => $department->id,
            ]);

            if ($request->hasFile('images')) {
                $uploadedImages = ImageController::storeImages($request, 'images', 'excuse-images');

                foreach ($uploadedImages as $uploadedImage) {
                    ExcuseImage::create([
                        'image_path' => $uploadedImage,
                        'excuse_id' => $excuse->id,
                    ]);
                }
            }

            return sendResponse($excuse, 'Excuse created successfully.');
        } catch (\Exception $e) {
            return sendError('An error occurred while creating the excuse.', $e->getMessage(), 500);
        }
    }


    public function edit(Request $request, $id)
    {
        $departments = Department::pluck('name')->toArray();
        $excuse = Excuse::findOrFail($id);
        return view('excuses.edit', compact('excuse', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string',
            'material' => 'required|in:Medical Report,Medical Examinations,Passport Photo,Other',
            'department' => 'required|exists:departments,name',
            'images.*' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error', $validator->errors());
        }

        try {
            $excuse = Excuse::findOrFail($id);

            $department = Department::where('name', $request->input('department'))->first();

            $excuse->update([
                'reason' => $request->input('reason'),
                'description' => $request->input('description'),
                'material' => $request->input('material'),
                'department_id' => $department->id,
            ]);

            if ($request->hasFile('images')) {
                $uploadedImages = ImageController::storeImages($request, 'images', 'excuse-images');
                $excuse->images()->delete();

                foreach ($uploadedImages as $uploadedImage) {
                    ExcuseImage::create([
                        'image_path' => $uploadedImage,
                        'excuse_id' => $excuse->id,
                    ]);
                }
            }

            return sendResponse($excuse, 'Excuse updated successfully.');
        } catch (\Exception $e) {
            return sendError('An error occurred while updating the excuse.', $e->getMessage(), 500);
        }
    }

    public function destroy(Excuse $excuse)
    {
        try {
            $excuse->delete();
            return sendResponse([], 'Excuse deleted successfully.');
        } catch (\Exception $e) {
            return sendError('An error occurred while deleting the excuse.', $e->getMessage(), 500);
        }
    }
}
