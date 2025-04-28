@extends('layouts.app')

@section('title', 'Predict Weekly Meal Plan')

@section('scripts')
<!-- Alpine.js for Print functionality -->
<script src="//unpkg.com/alpinejs" defer></script>

<script>
    function printSection() {
        let printableArea = document.getElementById('printable-content').innerHTML;
        let originalContent = document.body.innerHTML;

        document.body.innerHTML = printableArea;
        window.print();
        document.body.innerHTML = originalContent;
        window.location.reload(); // reload to restore Alpine and layout
    }
</script>
@endsection

@section('content')
<div x-data class="max-w-5xl mx-auto p-6 sm:p-8 bg-white dark:bg-gray-800 rounded-lg shadow-md mt-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 text-center">Predict Weekly Meal Plan</h1>

    <!-- Form Section (Not included in print) -->
    <form method="POST" action="{{ route('admin.prdections.data') }}" class="space-y-6 print:hidden">
        @csrf
        <div>
            <label for="disease" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Enter Disease:</label>
            <input 
                type="text" 
                name="disease" 
                id="disease" 
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                required
            >
        </div>
        <div class="text-center">
            <button type="submit" class="inline-flex justify-center items-center px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                Predict
            </button>
        </div>
    </form>

    @if(!empty($precautions) || !empty($weekly_meal_plan))
    <div class="mt-10 print:mt-0">

        <!-- Print Button -->
        <div class="flex justify-end mb-4 print:hidden">
            <button 
                @click="printSection()" 
                class="inline-flex justify-center items-center px-4 py-2 text-white bg-green-600 hover:bg-green-700 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
            >
                Print Report
            </button>
        </div>

        <!-- Printable Content -->
        <div id="printable-content" class="bg-white dark:bg-gray-800 p-4 rounded-lg">

            <p class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Hey this plan for you <span class="text-green-700">{{ Auth::user()->name }}</span></p>
            
            @if(!empty($precautions))
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Precautions:</h3>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300">
                        @foreach($precautions as $precaution)
                            <li>{{ $precaution }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(!empty($weekly_meal_plan))
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Weekly Meal Plan:</h3>

                    <div class="overflow-x-auto rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border border-gray-300 dark:border-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Day</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Meal</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Food</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($weekly_meal_plan as $day => $meals)
                                    @foreach($meals as $meal => $food)
                                        <tr>
                                            <td class="px-4 py-3 text-gray-900 dark:text-gray-200 font-semibold">{{ $day }}</td>
                                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $meal }}</td>
                                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $food }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
    @endif

</div>
@endsection