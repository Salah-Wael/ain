<?php

namespace App\Http\Controllers;

use App\Models\Excuse;
use Illuminate\Http\Request;

class ExcuseController extends Controller
{
    public function index()
    {
        $excuses = Excuse::with('student')->paginate(10);
        return view('excuses.index', compact('excuses'));
    }

    public function create()
    {
        return view('excuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
            'material' => 'required|in:Medical Report,Medical Examinations,Passport Photo,Other',
            'student_id' => 'required|exists:students,id',
            'head_of_department' => 'required|exists:head_of_departments,id',
            'images.*' => 'nullable|image|max:2048',
        ]);

        // Create the excuse record
        $excuse = Excuse::create($request->only([
            'reason',
            'description',
            'status',
            'material',
            'student_id',
            'head_of_department_id'
        ]));

        // Handle image uploads using ImageController
        if ($request->hasFile('images')) {
            $uploadedImages = ImageController::storeImages($request, 'images', 'excuses');

            foreach ($uploadedImages as $uploadedImage) {
                $excuse->images()->create(['image_path' => $uploadedImage]);
            }
        }

        return redirect()
            ->route('excuses.index')
            ->with('success', 'Excuse created successfully.');
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
