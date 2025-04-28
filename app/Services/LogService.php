<?php

namespace App\Services;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogService
{
    // Method to log errors
    public function logError(string $message, string $icon = 'fas fa-exclamation-triangle')
    {
        Log::create([
            'status' => 'error',
            'message' => $message . ' - Attempted by: ' . Auth::user()->name,
            'icon' => $icon,
        ]);
    }

    // Method to log success
    public function logSuccess(string $message, string $icon = 'fas fa-user-plus')
    {
        Log::create([
            'status' => 'success',
            'message' => $message . ' - Added by: ' . Auth::user()->name,
            'icon' => $icon,
        ]);
    }
}
