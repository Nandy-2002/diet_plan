<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Announcement extends Model
{
    protected $fillable = [
        'title', 'description', 'is_all_users', 'user_ids',
    ];

    protected $casts = [
        'user_ids' => 'array', // Cast user_ids to array
    ];

    public function users()
    {
        return User::whereIn('id', $this->user_ids)->get();
    }
    
}
