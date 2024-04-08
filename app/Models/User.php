<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lname',
        'Fname',
        'avatar',
        'google_id',
        'email',
        'phoneno',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'pincode',
        'email_verified_at',
        'password',
        'role_as',
    ];
}
