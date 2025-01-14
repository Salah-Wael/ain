<?php

namespace App\Http\Controllers;

use App\Models\Excuse;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageController;

class ExcuseController extends Controller
{
    public function index()
    {
        $excuses = Excuse::with('student')->paginate(10);
        return view('excuses.index', compact('excuses'));
    }

    public function studentExcuses()
    {
        $excuses = Excuse::with('student')->where('student_id', Auth::user()->id);
        return view('excuses.student-index', compact('excuses'));
    }

    public function create()
    {
        // Fetch all departments from the database
        $departments = Department::all();

        // Pass departments to the view
        return view('excuses.create', compact('departments'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'reason' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'status' => 'required|in:pending,approved,rejected',
    //         'material' => 'required|in:Medical Report,Medical Examinations,Passport Photo,Other',
    //         'student_id' => 'required|exists:students,id',
    //         'department' => 'required|exists:departments,name',
    //         'images.*' => 'nullable|image|max:2048',
    //     ]);

    //     // Retrieve the department ID based on the department name
    //     $department = Department::where('name', $request->input('department'))->first();

    //     // Create the excuse record
    //     $excuse = Excuse::create([
    //         'reason' => $request->input('reason'),
    //         'description' => $request->input('description'),
    //         'status' => $request->input('status'),
    //         'material' => $request->input('material'),
    //         'student_id' => Auth::user()->id, // Get the authenticated student's ID
    //         'department_id' => $department->id, // Assume the department has a HoD
    //     ]);

    //     // Handle image uploads
    //     if ($request->hasFile('images')) {
    //         $uploadedImages = ImageController::storeImages($request, 'images', 'excuses');

    //         foreach ($uploadedImages as $uploadedImage) {
    //             $excuse->images()->create(['image_path' => $uploadedImage]);
    //         }
    //     }

    //     return redirect()
    //         ->route('excuses.index')
    //         ->with('success', 'Excuse created successfully.');
    // }


    public function store(Request $request)
    {
        dd($request); // Debug

        // Validate the incoming request data
        $request->validate([
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
            'material' => 'required|in:Medical Report,Medical Examinations,Passport Photo,Other',
            'department' => 'required|exists:departments,name',
            'images.*' => 'nullable|image|max:2048',
        ]);

        // Retrieve the department ID based on the department name
        $department = Department::where('name', $request->input('department'))->first();

        // Create the excuse record using the authenticated student's ID and the department's ID
        $excuse = new Excuse([
            'reason' => $request->input('reason'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'material' => $request->input('material'),
            'student_id' => Auth::user()->id, // Get the authenticated student's ID
            'department_id' => $department->id,
        ]);

        // Handle image uploads using the ImageController and associate them with the excuse
        if ($request->hasFile('images')) {
            $uploadedImages = ImageController::storeImages($request, 'images', 'excuse-i');

            foreach ($uploadedImages as $uploadedImage) {
                $excuse->images()->create(['image_path' => $uploadedImage]); // Create the images for this excuse
            }
        }

        // Redirect with a success message
        return redirect()->route('excuses.index')->with('success', 'Excuse created successfully.');
        // $excuses = Excuse::with('student')->paginate(10);
        // return view('excuses.index', compact('excuses'));


    }

    public function show(Excuse $excuse)
    {
        $excuse->load('images');
        return view('excuses.show', compact('excuse'));
    }

    public function edit(Excuse $excuse)
    {
        return view('excuses.edit', compact('excuse'));
    }

    public function update(Request $request, Excuse $excuse)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
            'material' => 'required|in:Medical Report,Medical Examinations,Passport Photo,Other',
            'student_id' => 'required|exists:students,id',
            'head_of_department_id' => 'required|exists:head_of_departments,id',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $excuse->update($request->only(['reason', 'description', 'status', 'material', 'student_id', 'head_of_department_id']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('excuse_images', 'public');
                $excuse->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('excuses.index')->with('success', 'Excuse updated successfully.');
    }

    public function destroy(Excuse $excuse)
    {
        $excuse->delete();
        return redirect()->route('excuses.index')->with('success', 'Excuse deleted successfully.');
    }
}
