@extends('layouts.app')

@section('title', 'Home Page')

@section('scripts')

@endsection

@section('content')
  <div>
    <div class="container px-4  mx-auto grid">
      @php
            $hour = now()->hour;
            $greeting = '';
        
            if ($hour >= 5 && $hour < 12) {
                $greeting = 'Good Morning';
            } elseif ($hour >= 12 && $hour < 18) {
                $greeting = 'Good Afternoon';
            } else {
                $greeting = 'Good Evening';
            }
        @endphp
        
        <h2 class="my-6 text-2xl sm:text-md font-semibold text-gray-700 dark:text-gray-200">
            👋 {{ $greeting }}, {{ Auth::user()->name }}! Welcome to the Dashboard
        </h2>  
        <!-- CTA -->
        <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-green-100 bg-green-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-green" href="{{ route('admin.logs') }}">
          <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
            <span>Today Activity</span>
          </div>
          <span> View Log &RightArrow;</span>
        </a>
        @livewire('total-component')
        <!-- Health Tip Section -->
      <div class="bg-blue-100 p-4 rounded-lg shadow-md mt-8">
        <h3 class="text-xl font-semibold text-gray-800">Health Tip of the Day</h3>
        <p id="health-tip" class="text-gray-700 mt-2">Loading health tip...</p>
      </div>

      <h3 class="text-xl font-semibold mb-2 mt-10">Overall Meal Usage & Completion</h3>
      <canvas id="overallMealChart" height="100"></canvas>

      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
      document.addEventListener("DOMContentLoaded", function () {
          const overallCtx = document.getElementById('overallMealChart').getContext('2d');

          fetch("{{ route('admin.mealtracker.overallStats') }}")
              .then(res => res.json())
              .then(data => {
                  const labels = data.map(item => `${item.meal_type}: ${item.food}`);
                  const usersUsing = data.map(item => item.users_using);
                  const usersCompleted = data.map(item => item.users_completed);

                  new Chart(overallCtx, {
                      type: 'bar',
                      data: {
                          labels: labels,
                          datasets: [
                              {
                                  label: 'Users Using This Meal',
                                  data: usersUsing,
                                  backgroundColor: '#fbbf24',
                              },
                              {
                                  label: 'Users Completed',
                                  data: usersCompleted,
                                  backgroundColor: '#10b981',
                              }
                          ]
                      },
                      options: {
                          responsive: true,
                          indexAxis: 'y',
                          scales: {
                              x: {
                                  beginAtZero: true,
                                  ticks: {
                                      precision: 0
                                  }
                              }
                          }
                      }
                  });
              });
      });
      </script>

      <script>
        document.addEventListener("DOMContentLoaded", function() {
          // Fetch random advice from the Advice Slip API
          fetch('https://api.adviceslip.com/advice')
            .then(response => response.json())
            .then(data => {
              const healthTip = data.slip.advice; // Extract the advice from the response
              document.getElementById('health-tip').textContent = healthTip; // Display the advice
            })
            .catch(error => {
              console.error('Error fetching advice:', error);
              document.getElementById('health-tip').textContent = 'Failed to load health tip.';
            });
        });
      </script>
    </div>
  </div>
@endsection

@section('scripts')

@endsection