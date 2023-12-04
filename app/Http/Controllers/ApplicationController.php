<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Course;
use App\Models\Department;
use App\Models\Application;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ApplicationController extends Controller
{

    /**
     * Создание новой заявки.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Проверка входных данных запроса
        $request->validate([
            'fio' => 'required|string',
            'birth_date' => 'required|date',
            'nationality' => 'required|string',
            'gender' => 'required|string',
            'statement_photo' => 'required|mimes:jpeg,png,pdf',
            'iin' => 'required|string',
            'photo_3_4' => 'required|mimes:jpeg,png',
            'education_work_certificate' => 'required|mimes:jpeg,png,pdf',
            'payment_receipt' => 'required|mimes:jpeg,png',
            'medical_certificate' => 'required|mimes:jpeg,png',
            'fluorography' => 'required|mimes:jpeg,png',
            'residence_address' => 'required|string',
        ]);


        $application = Application::create([
            'fio' => $request->input('fio'),
            'birth_date' => $request->input('birth_date'),
            'nationality' => $request->input('nationality'),
            'gender' => $request->input('gender'),
            'statement_photo' => $request->file('statement_photo')->store('documents'),
            'iin' => $request->input('iin'),
            'photo_3_4' => $request->file('photo_3_4')->store('photos'),
            'education_work_certificate' => $request->file('education_work_certificate')->store('documents'),
            'payment_receipt' => $request->file('payment_receipt')->store('photos'),
            'medical_certificate' => $request->file('medical_certificate')->store('photos'),
            'fluorography' => $request->file('fluorography')->store('photos'),
            'residence_address' => $request->input('residence_address'),
            'statusaplication_id' => 'NEW',
        ]);

        return redirect()->route('createapplication')->with('success', 'Application added successfully');
    }


}
