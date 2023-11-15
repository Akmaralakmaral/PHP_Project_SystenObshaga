<?php

namespace App\Http\Controllers;
use App\Models\Faculty;
use App\Http\Controllers\Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class FacultyController extends Controller
{


    public function showFaculty()
    {
        $faculties = Faculty::all();
        return view('admin.faculties', compact('faculties'));
    }

    public function createFaculty(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name_faculty' => 'required|string|max:255',
        ]);

        // Create a new faculty
        Faculty::create([
            'name_faculty' => $request->input('name_faculty'),
        ]);

        return Redirect::route('faculties')->with('success', 'Faculty added successfully');
    }

    public function updateFaculty(Faculty $faculty, Request $request): RedirectResponse
    {
        // Validate the form data
        $request->validate([
            'name_faculty' => 'required|string|max:255',
        ]);

        // Update faculty data
        $faculty->name_faculty = $request->input('name_faculty');
        $faculty->save();

        return redirect()->route('faculties')->with('success', 'Faculty updated successfully');
    }

    public function destroy_faculty(Faculty $faculty)
    {
        // Ваш код для удаления пользователя
        $faculty->delete();

        return redirect()->route('faculties')->with('success', 'Faculty deleted successfully');
    }



}
