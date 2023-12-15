<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassModel extends Model
{
    use HasFactory;
    protected $table = 'passes';
    protected $fillable = [
    'id',
    'student_id',
    'start_date',
    'end_date',
    'room_id',
    'employee_id'
    ];


}
