<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Faculty;
use App\Http\Controllers\Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function showDepartment()
    {
       $departments = Department::all();
        $faculties = Faculty::all();

        return view('admin.departments', compact('departments', 'faculties'));
    }

    public function createDepartment(Request $request)
    {
        $faculties = Faculty::all();

        $request->validate([
            'department_name' => 'required|string|max:255',
            'faculty_id' => 'required|exists:faculties,id',
        ]);


        Department::create([
            'department_name' => $request->input('department_name'),
            'faculty_id' => $request->input('faculty_id'),
        ]);

        return redirect()->route('departments')->with('success', 'Department added successfully');
    }

    public function updateDepartment(Department $department, Request $request): RedirectResponse
    {

        $request->validate([
            'department_name' => 'required|string|max:255',
            'faculty_id' => 'required|exists:faculties,id',
        ]);


        $department->department_name = $request->input('department_name');
        $department->faculty_id = $request->input('faculty_id');
        $department->save();

        return redirect()->route('departments')->with('success', 'Faculty updated successfully');
    }

    public function destroy_department(Department $department)
    {
        // Ваш код для удаления пользователя
        $department->delete();

        return redirect()->route('departments')->with('success', 'Department deleted successfully');
    }
}
