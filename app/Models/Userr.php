<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Userr extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
