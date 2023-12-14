<?php

namespace App\Http\Controllers;
use App\Models\Application;
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
            abort(404); // или выполните другие действия, если заявка не найдена
        }

        return view('commandant.applicationdetails', compact('application'));
    }

}
