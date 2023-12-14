<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObshagaModel extends Model
{
    use HasFactory;
     protected $table = 'obshagas';

    protected $fillable =
    [
        'id',
        'name_obshaga'
    ];
}
