<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Student;
use App\Models\User;
use Mail;
use App\Mail\newMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    public function send()
    {
        // Отправка сообщения текущему пользователю




    }

    public function email()
    {
        return view('email');
    }



    public function upload(Request $request)
    {
        $stat_ph_path = $request->file('stat_ph_path_img')->store('stat_ph', 'public');
        $edu_w_cert_path = $request->file('edu_w_cert_path_img')->store('edu_w_cert', 'public');
        $ph_3_4_path = $request->file('ph_3_4_path_img')->store('ph_3_4', 'public');
        $pay_rec_path = $request->file('pay_rec_path_img')->store('pay_rec', 'public');
        $med_cert_path = $request->file('med_cert_path_img')->store('med_cert', 'public');
        $fluor_path = $request->file('fluor_path_img')->store('fluor', 'public');


        $application = Application::create([
            'fio' => $request->input('fio'),
            'birth_date' => $request->input('birth_date'),
            'nationality' => $request->input('nationality'),
            'gender' => $request->input('gender'),
            'passport_id' => $request->input('passport_id'),
            'issuing_authority' => $request->input('issuing_authority'),
            'iin' => $request->input('inn'),
            'statement_photo_path' => $stat_ph_path,
            'education_work_certificate_path' => $edu_w_cert_path,
            'photo_3_4_path' => $ph_3_4_path,
            'payment_receipt_path' => $pay_rec_path,
            'medical_certificate_path' => $pay_rec_path,
            'fluorography_path' => $fluor_path,
            'residence_address' => $request->input('residence_address'),
            'user_id' => $request->user()->id,
            'student_id' => $request->user()->student->id,
            'employee_id' => $request->has('employee_id') ? $request->input('employee_id') : null,
            'statusaplication_id' => $request->input('statusaplication_id') ?? 1,


        ]);

         $currentUser = Auth::user();
        $currentUserEmail = $currentUser ? $currentUser->email : null;

        if ($currentUserEmail) {
            $newMailCurrentUser = new newMail($currentUserEmail);
            Mail::send($newMailCurrentUser);
        }


        // Отправка сообщений всем пользователям с 'user_role' равным 'student'
        $students = User::where('user_role', 'commandant')->get();

        foreach ($students as $student) {
            $studentEmail = $student->email;
            $newMailStudent = new newMail($studentEmail);
            Mail::send($newMailStudent);
        }
        return view('student.application');
    }



}
