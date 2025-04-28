<?php

namespace App\Livewire;

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserAnnouncements extends Component
{
    public $announcements;

    public function mount()
    {
        $this->announcements = Announcement::where(function($query) {
            // Get announcements for all users or specifically for the authenticated user
            $query->where('is_all_users', true)
                  ->orWhere('user_ids', 'like', '%"' . Auth::id() . '"%');
        })->get();
    }

    public function render()
    {
        return view('livewire.user-announcements');
    }
}