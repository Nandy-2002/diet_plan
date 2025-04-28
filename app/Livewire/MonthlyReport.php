<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Income;
use App\Models\Expense;

class MonthlyReport extends Component
{
    public $currentMonth;
    public $currentYear;
    public $income = 0;
    public $expenses = 0;
    public $profit = 0;
    public $year;
    public $month;
    public $combined = [];

    public function mount()
    {
        $this->currentMonth = Carbon::now()->month;
        $this->currentYear = Carbon::now()->year;
        $this->year = $this->currentYear;
        $this->month = $this->currentMonth;
        $this->fetchData();
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

        $incomeRecords = Income::whereYear('entry_date', $this->year)
            ->whereMonth('entry_date', $this->month)
            ->get()
            ->map(function ($income) {
                return [
                    'date' => Carbon::parse($income->entry_date)->format('d F Y h:i A'),
                    'amount' => $income->amount,
                    'description' => $income->description,
                    'category' => $income->incomeCategory->name,
                    'type' => 'Income',
                ];
            });

        $expenseRecords = Expense::whereYear('entry_date', $this->year)
            ->whereMonth('entry_date', $this->month)
            ->get()
            ->map(function ($expense) {
                return [
                    'date' => Carbon::parse($expense->entry_date)->format('d F Y h:i A'),
                    'amount' => $expense->amount,
                    'description' => $expense->description,
                    'category' => $expense->expenseCategory->name,
                    'type' => 'Expense',
                ];
            });

        $this->combined = $incomeRecords->concat($expenseRecords)->sortBy('date')->values()->all();
        $this->dispatch('dataUpdated');
    }

    public function render()
    {
        return view('livewire.monthly-report');
    }
}
