<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\CanResetPassword;

class Application extends Model
{

    use HasApiTokens, HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'fio',
        'birth_date',
        'nationality',
        'gender',
        'passport_id',
        'issuing_authority',
        'iin',
        'statement_photo',
        'photo_3_4',
        'education_work_certificate',
        'payment_receipt',
        'medical_certificate',
        'fluorography',
        'residence_address',
        'user_id',
        'student_id',
        'employee_id',
        'statusaplication_id'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',

    ];
}
