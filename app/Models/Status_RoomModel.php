<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_RoomModel extends Model
{
    use HasFactory;

     protected $table = 'status_rooms';

    protected $fillable =
    [
        'id',
        'status_rooms'
    ];
}
