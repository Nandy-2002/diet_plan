<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class TestComponent extends Component
{
    public $totalUsers;

    public function mount()
    {
        // Fetch the total users from the database
        $this->totalUsers = User::count();
    }
    public function render()
    {
        return view('livewire.test-component');
    }
}
