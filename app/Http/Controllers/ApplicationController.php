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
     * Отображает форму для создания заявки.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('student.createapplication'); // Замените 'applications.create' на имя вашего представления для создания заявки
    }

    /**
     * Сохраняет новую заявку в базе данных.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Валидация данных
        $request->validate([
            'fio' => 'required|string',
            'birth_date' => 'required|date',
            'nationality' => 'required|string',
            'gender' => 'required|string',
            'passport_id' => 'required|string',
            'issuing_authority' => 'required|string',
            'iin' => 'required|string',
            'statement_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_3_4' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'education_work_certificate' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'payment_receipt' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'medical_certificate' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fluorography' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'residence_address' => 'required|string',


        ]);

        // Создание новой заявки
       // Application::create($request->all());
//$newEmployee->user_id = $request->user()->id;

        $application = Application::create([
            'fio' => $request->fio,
            'birth_date' => $request->birth_date,
            'nationality' => $request->nationality,
            'gender' => $request->gender,
            'passport_id' => $request->passport_id,
            'issuing_authority' => $request->issuing_authority,
            'iin' => $request->iin,
            'statement_photo' => $request->statement_photo,
            'photo_3_4' => $request->photo_3_4,
            'education_work_certificate' => $request->education_work_certificate,
            'payment_receipt' => $request->payment_receipt,
            'medical_certificate' => $request->medical_certificate,
            'fluorography' => $request->fluorography,
            'residence_address' => $request->residence_address,
            'user_id' => $request->user()->id,
            'student_id' => $request->student()->id,
            'employee_id' => null,
            'statusaplication_id' => 1,
        ]);


        return redirect()->route('dashboard') // Замените 'applications.index' на имя вашего маршрута для списка заявок
            ->with('success', 'Заявка успешно создана.');
    }

}
