<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_Aplication extends Model
{
    use HasFactory;


    protected $fillable = [
    'id',
    'status_aplication',
];

// Если у вас есть кастомное имя таблицы, укажите его явно:
protected $table = 'status_aplications';

}
