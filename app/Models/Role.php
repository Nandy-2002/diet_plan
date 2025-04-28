<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'permission_array'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
