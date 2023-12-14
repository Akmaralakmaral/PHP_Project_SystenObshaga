<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_GenderModel extends Model
{
    use HasFactory;

    protected $table = 'rooms_gender';

    protected $fillable =
    [
        'id',
        'room_number',
        'roomGender',
        'obshaga_id',
        'room_status_id'
    ];

    public function obshaga()
    {
        // Make sure the namespace and class name are correct
        return $this->belongsTo(ObshagaModel::class, 'obshaga_id');
    }

    public function room_status()
    {
        // Make sure the namespace and class name are correct
        return $this->belongsTo(Status_RoomModel::class, 'room_status_id');
    }
}
