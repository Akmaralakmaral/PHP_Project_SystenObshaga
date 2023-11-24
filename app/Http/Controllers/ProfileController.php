<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Course;
use App\Models\Department;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        if ($request->user()->user_role === 'student') {
        $student = Student::where('user_id', $request->user()->id)->first();
        $faculties = Faculty::all();
        $departments = Department::all(); // Add this line

        // Corrected this line
        $course = $student ? Course::where('id', $student->id)->first() : null;

        return view('profile_students.edit', [
            'user' => $request->user(),
            'student' => $student,
            'faculties' => $faculties,
            'departments' => $departments, // Add this line
            'course' => $course,
        ]);
    } elseif ($request->user()->user_role === 'employee') {
            $employee = Employee::where('user_id', $request->user()->id)->first();

            return view('profile_employee.edit', [
                'user' => $request->user(),
                'employee' => $employee,
            ]);
        } else {
            return view('profile.edit', [
                'user' => $request->user(),
            ]);
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
          $user = $request->user();

            if ($user->user_role === 'student') {
                $request->user()->fill($request->validated());

                if ($request->user()->isDirty('email')) {
                    $request->user()->email_verified_at = null;
                }

                $request->user()->save();

                $student = Student::where('user_id', $request->user()->id)->first();

                if ($student) {
                    // Update the existing student record
                    $student->update([
                        'faculty_id' => $request->input('faculty_id'),
                        'department_id' => $request->input('department_id'),
                        'group' => $request->input('group'),
                        'direction' => $request->input('direction'),
                        'phone_number' => $request->input('phone_number'),

                    ]);

                    $course = Course::where('id', $student->id)->first();

                    if ($course) {
                        // Update the existing course record
                        $course->update([
                            'degree' => $request->input('degree'),
                            'course_name' => $request->input('course_name'),
                        ]);
                    } else {
                        // Create a new course record for the user
                        $newCourse = new Course();
                        $newCourse->id = $student->id;
                        $newCourse->degree = $request->input('degree');
                        $newCourse->course_name = $request->input('course_name');
                        $newCourse->save();
                    }
                } else {
                    // Create a new student record for the user
                    $newStudent = new Student();
                    $newStudent->user_id = $request->user()->id;
                    $newStudent->faculty_id = $request->input('faculty_id');
                    $newStudent->department_id = $request->input('department_id');
                    $newStudent->group = $request->input('group');
                    $newStudent->direction = $request->input('direction');
                    $newStudent->phone_number = $request->input('phone_number');



                    // // Create a new course record for the user
                    // $newCourse = new Course();
                    // $newCourse->id = $newStudent->id;
                    // $newCourse->degree = $request->input('degree');
                    // $newCourse->course_name = $request->input('course_name');
                    // $newCourse->save();
                    // // $newCourse->course()->save($newCourse);
                    // $newStudent->save();
                }

                // Save the actual faculty and department names instead of IDs
                $faculty = Faculty::find($request->input('faculty_id'));
                $department = Department::find($request->input('department_id'));

                return Redirect::route('profile_students.edit')->with([
                    'status' => 'profile-updated',
                    'faculty' => $faculty->name_faculty,
                    'department' => $department->department_name,
                ]);
            } elseif ($user->user_role === 'employee') {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            $employee = Employee::where('user_id', $request->user()->id)->first();

            if ($employee) {
                // Update the existing employee record
                $employee->update([
                    'specialty_name' => $request->input('specialty_name'),
                    'phone_number' => $request->input('phone_number'),
                ]);
            } else {
                // Create a new employee record for the user
                $newEmployee = new Employee();
                $newEmployee->user_id = $request->user()->id;
                $newEmployee->specialty_name = $request->input('specialty_name');
                $newEmployee->phone_number = $request->input('phone_number');
                $newEmployee->save();
            }

            return Redirect::route('profile_employee.edit')->with('status', 'profile-updated');
        } else {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}