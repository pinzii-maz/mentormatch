<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mentor extends Authenticatable
{
     use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'gender',
        'education',
        'job',
        'expertise',
        'reason',
        'file',
    ];
}
