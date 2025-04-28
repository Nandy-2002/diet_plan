@extends('layouts.app')

@section('title', 'Weekly Meal Plan')

@section('scripts')
    <script>
        function printPage() {
            var printWindow = window.open('', '_blank');
            var content = document.getElementById('printable').innerHTML;
            printWindow.document.write('<html><head><title>Weekly Meal Plan</title>');
            printWindow.document.write('<style>body{font-family: Arial, sans-serif; margin: 20px;} table{width: 100%; border-collapse: collapse;} th, td{padding: 8px 12px; border: 1px solid #ddd;} th{text-align: left;} h1, h3{color: #333;}</style></head>');
            printWindow.document.write('<body>');
            printWindow.document.write('<h1>Weekly Meal Plan</h1>');
            printWindow.document.write('<p>Prepared for: <strong>{{ Auth::user()->name }}</strong></p>');
            printWindow.document.write(content);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
@endsection

@section('content')
<div class="container mx-auto mt-8 px-4 dark:bg-gray-900 dark:text-white">
    <h1 class="text-3xl font-semibold mb-4">Weekly Meal Plan</h1>

    @if(session('danger'))
        <div class="alert alert-danger">{{ session('danger') }}</div>
    @endif

    @if($weekly_meal_plan && $precautions)
        <div id="printable" class="bg-white shadow-sm rounded-lg p-6 dark:bg-gray-800 dark:text-white">
            <h3 class="text-2xl font-semibold mb-3">Precautions for Your Condition</h3>
            <ul class="list-disc pl-5 mb-6">
                @foreach($precautions as $precaution)
                    <li>{{ $precaution }}</li>
                @endforeach
            </ul>

            <h3 class="text-2xl font-semibold mb-3">Meal Plan for the Week</h3>
            <table class="table-auto w-full border-collapse border border-gray-200 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Day</th>
                        <th class="px-4 py-2 text-left">Breakfast</th>
                        <th class="px-4 py-2 text-left">Lunch</th>
                        <th class="px-4 py-2 text-left">Dinner</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($weekly_meal_plan as $day => $meals)
                        <tr>
                            <td class="px-4 py-2 border-t border-gray-200 dark:border-gray-700">{{ $day }}</td>
                            <td class="px-4 py-2 border-t border-gray-200 dark:border-gray-700">{{ $meals['Breakfast'] }}</td>
                            <td class="px-4 py-2 border-t border-gray-200 dark:border-gray-700">{{ $meals['Lunch'] }}</td>
                            <td class="px-4 py-2 border-t border-gray-200 dark:border-gray-700">{{ $meals['Dinner'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <button class="btn btn-primary py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="printPage()">Print Weekly Meal Plan</button>
        </div>
    @else
        <div class="alert alert-warning mt-4 p-4 bg-yellow-100 text-yellow-800 rounded-lg dark:bg-yellow-500 dark:text-yellow-900">
            Kindly add the disease information on your user page to generate the meal plan.
        </div>
    @endif
</div>
@endsection
