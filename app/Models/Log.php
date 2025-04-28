<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if using pluralized naming convention)
    protected $table = 'logs';

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'status',
        'message',
        'icon',
    ];

    // Optionally, if you want to use timestamps
    public $timestamps = true;

    // If you want to customize the timestamp fields
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}