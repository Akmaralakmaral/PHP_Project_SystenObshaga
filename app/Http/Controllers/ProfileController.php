<?php

namespace App\Http\Controllers;
use App\Models\Employee;
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
        return view('profile_students.edit', [
            'user' => $request->user(),
        ]);        }
        elseif ($request->user()->user_role === 'employee') {
            $employee = Employee::where('user_id',$request->user()->id )->first();

            return view('profile_employee.edit',
                [
                    'user' => $request->user(),
                    'employee' => $employee
                ]);
        }
        else {
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
        if ($request->user()->user_role === 'student') {

            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }
            $request->user()->save();
            return Redirect::route('profile_students.edit')->with('status', 'profile-updated');

        }
        elseif ($request->user()->user_role === 'employee') {
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

        }
        else {

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
