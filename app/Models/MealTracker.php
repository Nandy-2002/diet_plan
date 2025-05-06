<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTracker extends Model
{
    protected $fillable = ['user_id', 'day', 'meal_type', 'food', 'is_finished'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
