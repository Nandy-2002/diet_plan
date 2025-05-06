@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6">{{ now()->format('l') }} - Today's Meals</h2>

    @if($today_meal_plan)
    <div class="space-y-4 mb-8">
        @foreach($today_meal_plan as $mealType => $food)
            @php
                $meal = \App\Models\MealTracker::where('user_id', auth()->id())
                    ->where('day', now()->format('l'))
                    ->where('meal_type', $mealType)
                    ->first();
            @endphp
            <div class="flex items-center justify-between bg-white shadow p-4 rounded-lg">
                <div class="{{ $meal && $meal->is_finished ? 'line-through text-gray-400' : '' }}">
                    <strong>{{ $mealType }}:</strong> {{ $food }}
                </div>
                @if(!$meal || !$meal->is_finished)
                <form action="{{ route('admin.mealtracker.update', ['meal' => $mealType]) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="meal_type" value="{{ $mealType }}">
                    <input type="hidden" name="food" value="{{ $food }}">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">Mark as Finished</button>
                </form>
                @else
                <span class="text-green-600 font-semibold">Completed</span>
                @endif
            </div>
        @endforeach
    </div>
    @endif

    <h3 class="text-xl font-semibold mb-2">Precautions</h3>
    <ul class="list-disc pl-6 text-gray-700 mb-8">
        @foreach($precautions as $precaution)
            <li>{{ $precaution }}</li>
        @endforeach
    </ul>

    <h3 class="text-xl font-semibold mb-2">Today's Progress</h3>
    <div class="w-full bg-gray-200 rounded-full h-5 mb-4">
        <div class="bg-blue-600 h-5 rounded-full text-xs text-white text-center"
             style="width: {{ $totalMeals > 0 ? ($completedMeals / $totalMeals) * 100 : 0 }}%;">
            {{ round(($completedMeals / $totalMeals) * 100) }}%
        </div>
    </div>
    <p class="mb-6">{{ $completedMeals }} out of {{ $totalMeals }} meals completed today.</p>

    <h3 class="text-xl font-semibold mb-2">Weekly Completion Overview</h3>
    <canvas id="weeklyChart" height="100"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('weeklyChart').getContext('2d');

    fetch("{{ route('admin.mealtracker.weeklyStats') }}")
        .then(res => res.json())
        .then(data => {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.days,
                    datasets: [{
                        label: 'Completed Meals',
                        data: data.completed,
                        backgroundColor: '#3b82f6',
                    }, {
                        label: 'Total Meals',
                        data: data.total,
                        backgroundColor: '#d1d5db',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
});
</script>
@endsection
