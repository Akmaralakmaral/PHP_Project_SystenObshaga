<?php

namespace App\Http\Controllers;
use App\Models\Application;
use App\Models\Student;
use App\Mail\ApplicationNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class CheckApplicationController extends Controller
{
    public function showApplications()
    {
        $applications = Application::all();
        return view('commandant.applications', compact('applications'));
    }

    public function showApplicationDetails($id)
    {
        $application = Application::find($id);

        if (!$application) {
            abort(404);
        }

        $student = Student::where('user_id', $application->user_id)->first();

        return view('commandant.applicationdetails', compact('application', 'student'));
    }

    public function index()
    {
        // Your logic for displaying rooms goes here

        return view('commandant.rooms'); // Assuming 'commandant.rooms' is your view file
    }


     public function goToRooms($id)
    {
        $application = Application::find($id);

        if (!$application) {
            abort(404);
        }

        // Update statusaplication_id to 2 (assuming 2 corresponds to the desired status)
        $application->statusaplication_id = 2;
        $application->save();

        // Redirect to the 'rooms' page or wherever you want
        return redirect()->route('commandant.rooms')->with('status', 'Status updated successfully!');
    }

   public function sendApplicationNotification($id)
    {
        $application = Application::find($id);

        if (!$application) {
            abort(404);
        }

        $application->statusaplication_id = 3;
        $application->save();


        // Send email
        Mail::to($application->user->email)->send(new ApplicationNotification($application));

        // Redirect back or wherever you want
        return redirect()->back()->with('status', 'Notification email sent successfully!');
    }

}
