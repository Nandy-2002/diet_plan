<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    // Add the necessary fields to the fillable property
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'popup_message',
        'user_role',
        'role_id',
        'dob',
        'gender',
        'age',
        'disease_name',
    ];

    // Define the relationship with the Role model
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Optionally, you can add casts for fields that need to be treated as specific types
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date', // Cast dob as a date
    ];

    // Optionally, add mutators for any field if needed, e.g. for password encryption
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
