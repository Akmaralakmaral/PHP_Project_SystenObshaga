<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'id',
        'fio',
        'birth_date',
        'nationality',
        'gender',
        'passport_id',
        'issuing_authority',
        'iin',
        'statement_photo_path',
        'education_work_certificate_path',
        'photo_3_4_path',
        'payment_receipt_path',
        'medical_certificate_path',
        'fluorography_path',
        'residence_address',
        'user_id',
        'student_id',
        'employee_id',
        'statusaplication_id'
    ];
    public function statusaplication()
    {
        return $this->belongsTo(Status_Aplication::class, 'statusaplication_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
