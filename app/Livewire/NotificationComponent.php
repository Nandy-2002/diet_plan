<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification; 

class NotificationComponent extends Component
{
    public $notifications = [];
    public $toastMessage = '';
    public $toastType = ''; // success, error, etc.

    protected $listeners = [
        'some-event' => '$refresh'
    ];

    public function mount()
    {
        $this->loadNotifications(); // Load notifications initially
    }

    public function loadNotifications()
    {
        // Fetch notifications and assign to the property
        $this->notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            $this->toastMessage = 'Notification marked as read!';
            $this->toastType = 'success'; // Set toast type
            $this->loadNotifications(); // Refresh notifications
        }
    }

    public function deleteNotification($notificationId)
    {
        $notification = Notification::find($notificationId);
        
        if ($notification) {
            $notification->delete();
            $this->toastMessage = 'Notification deleted successfully!';
            $this->toastType = 'success';
        } else {
            $this->toastMessage = 'Notification not found!';
            $this->toastType = 'error'; // Set toast type
        }
        
        // Reload notifications to update the UI
        $this->loadNotifications();
    }

    public function clearAll()
    {
        // Clear notifications from the database
        Notification::where('user_id', auth()->id())->delete();
        
        // Clear the notifications property to update the UI
        $this->notifications = []; 
        
        // Set a success message
        $this->toastMessage = 'All notifications cleared!';
        $this->toastType = 'success'; // Set toast type

        $this->dispatch('some-event');
        
        // Reload notifications to update the UI
        $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.notification-component');
    }
}