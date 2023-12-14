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
//use Illuminate\Auth\Passwords\CanResetPassword;
use App\Http\Middleware\TrustHosts;

class Student extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'department_id', // Correct attribute name
        'faculty_id',
        'course_id',
        'group',
        'direction',
        'phone_number',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',

    ];


     public function faculty()
        {
            return $this->belongsTo(Faculty::class);
        }

     public function course()
        {
            return $this->belongsTo(Course::class);
        }

         public function department()
        {
            return $this->belongsTo(Department::class);
        }

}
