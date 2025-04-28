<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class TotalComponent extends Component
{
    public $totalUsers;

    public function mount()
    {
        // Fetch the total users, income, and expenses from the database
        $this->totalUsers = User::count();
    }

    public function render()
    {
        return view('livewire.total-component');
    }
}