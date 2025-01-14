<?php

namespace App\Http\Controllers;

use App\Models\Excuse;
use App\Models\Department;
use App\Models\ExcuseImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageController;

class ExcuseController extends Controller
{
    public function index()
    {
        $excuses = Excuse::with('student')
        ->where('status', 'pending')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('excuses.index', compact('excuses'));
    }

    public function studentExcuses()
    {
        $excuses = Excuse::with('student', 'images')->where('student_id', Auth::user()->id)->get();
        return view('excuses.student-index', compact('excuses'));
    }

    public function create()
    {
        // Fetch all departments from the database
        $departments = Department::all();

        // Pass departments to the view
        return view('excuses.create', compact('departments'));
    }

    public function show(Excuse $excuse)
    {
        $excuse->load('images');
        return view('excuses.show', compact('excuse'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string',
            'material' => 'required|in:Medical Report,Medical Examinations,Passport Photo,Other',
            'department' => 'required|exists:departments,name',
            'images.*' => 'nullable|image|max:2048',
        ]);

        // Retrieve the department ID based on the department name
        $department = Department::where('name', $request->input('department'))->first();

        // Create the excuse record using the authenticated student's ID and the department's ID
        $excuse = Excuse::create([
            'reason' => $request->input('reason'),
            'description' => $request->input('description'),
            'material' => $request->input('material'),
            'student_id' => Auth::user()->id, // Get the authenticated student's ID
            'department_id' => $department->id,
        ]);

        // Handle image uploads using the ImageController and associate them with the excuse
        if ($request->hasFile('images')) {
            $uploadedImages = ImageController::storeImages($request, 'images', 'excuse-images');

            foreach ($uploadedImages as $uploadedImage) {
                ExcuseImage::create([
                    'image_path' => $uploadedImage,
                    'excuse_id' => $excuse->id,
                ]); // Create the images for this excuse
            }
        }

        // Redirect with a success message
        return redirect()->route('excuses.student')->with('success', 'Excuse created successfully.');

    }

    public function edit(Request $request, $id)
    {
        $departments = Department::all();
        $excuse = Excuse::findOrFail($id);
        return view('excuses.edit', compact('excuse'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string',
            'material' => 'required|in:Medical Report,Medical Examinations,Passport Photo,Other',
            'student_id' => 'required|exists:students,id',
            'department' => 'required|exists:departments,name',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $excuse = Excuse::findOrFail($id);
        $department = Department::where('name', $request->input('department'))->first();

        $excuse->update([
            'reason' => $request->input('reason'),
            'description' => $request->input('description'),
            'material' => $request->input('material'),
            'student_id' => Auth::user()->id, // Get the authenticated student's ID
            'department_id' => $department->id,
        ]);

        if ($request->hasFile('images')) {
            $uploadedImages = ImageController::storeImages($request, 'images', 'excuse-images');

            $excuse->images()->delete(); // Delete existing images

            foreach ($uploadedImages as $uploadedImage) {
                ExcuseImage::create([
                    'image_path' => $uploadedImage,
                    'excuse_id' => $excuse->id,
                ]);
            }
        }
        return redirect()->route('excuses.student')->with('success', 'Excuse updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $excuse = Excuse::findOrFail($id);

        $excuse->update(['status' => $request->status]);

        return redirect()->route('excuses.index')->with('success', 'Excuse Approved successfully.');
    }

    public function destroy(Excuse $excuse)
    {
        $excuse->delete();
        return redirect()->route('excuses.index')->with('success', 'Excuse deleted successfully.');
    }
}
