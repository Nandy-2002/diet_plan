<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = ['user_id', 'disease_name', 'feedback'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
