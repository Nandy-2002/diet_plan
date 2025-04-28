<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Income;
use App\Models\Expense;

class MonthlyCharts extends Component
{
    public $currentMonth;
    public $currentYear;
    public $income = 0;
    public $expenses = 0;
    public $profit = 0;
    public $year;
    public $month;

    protected $listeners = [
        'refreshChart' => '$refresh', // To handle refresh requests
        'fetchData' => 'fetchData'    // To fetch data when the filter is applied
    ];
    
    public function mount()
    {
        $now = Carbon::now();
        $this->year = $this->currentYear = $now->year;
        $this->month = $this->currentMonth = $now->month;

        $this->income = Income::whereYear('entry_date', $this->year)
                            ->whereMonth('entry_date', $this->month)
                            ->sum('amount');

        $this->expenses = Expense::whereYear('entry_date', $this->year)
                                ->whereMonth('entry_date', $this->month)
                                ->sum('amount');

        $this->profit = $this->income - $this->expenses;
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'year' || $propertyName === 'month') {
            $this->fetchData();
        }
    }

    public function fetchData()
    {
        $this->income = Income::whereYear('entry_date', $this->year)
            ->whereMonth('entry_date', $this->month)
            ->sum('amount');

        $this->expenses = Expense::whereYear('entry_date', $this->year)
            ->whereMonth('entry_date', $this->month)
            ->sum('amount');

        $this->profit = $this->income - $this->expenses;

        // Corrected: Dispatch the browser event for the chart
        $this->dispatch('update-charts');
    }

    public function render()
    {
        return view('livewire.monthly-charts');
    }
}