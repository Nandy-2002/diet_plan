<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex flex-col flex-1 w-full">
      <a href="{{ route('login') }}">Login</a>
    </div>

    <div class="container mx-auto px-4 py-8">

      <!-- Event Section -->
      <div class="bg-white shadow-md rounded-lg p-6 mb-8">
          <h2 class="text-2xl font-semibold mb-4">Event Section</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
              @foreach($events as $event)
                  <div class="bg-white shadow-md rounded-lg overflow-hidden">
                      <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                      <div class="p-4">
                          <h2 class="text-lg font-semibold">{{ $event->title }}</h2>
                          <p class="text-gray-600">{{ $event->description }}</p>
                          <p class="text-gray-600">Event Date: {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</p>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
  
      <!-- Upcoming Event Section -->
      <div class="bg-white shadow-md rounded-lg p-6 mb-8">
          <h2 class="text-2xl font-semibold mb-4">Upcoming Events</h2>
          @if($upcomingEvents->isEmpty())
              <p>No upcoming events.</p>
          @else
              <ul>
                  @foreach($upcomingEvents as $upcomingEvent)
                      <li class="mb-2">
                          <strong>{{ $upcomingEvent->title }}</strong>
                          <span> on {{ \Carbon\Carbon::parse($upcomingEvent->start_date)->format('M d, Y h:i A') }}</span>
                      </li>
                  @endforeach
              </ul>
          @endif
      </div>
  
      <!-- Latest Events Section -->
      <div class="bg-white shadow-md rounded-lg p-6 mb-8">
          @if($latestEvents->isNotEmpty())
              <h2 class="text-2xl font-semibold mb-4">Latest Events</h2>
              @foreach($latestEvents as $latestEvent)
                  <div class="mb-4">
                      <h3 class="text-xl font-semibold">{{ $latestEvent->title }}</h3>
                      <p><strong>Event Date:</strong> {{ \Carbon\Carbon::parse($latestEvent->start_date)->format('M d, Y') }}</p>
                      <h4 class="text-lg font-semibold mt-2">Requirements</h4>
                      <table class="min-w-full bg-white">
                          <thead>
                              <tr>
                                  <th class="py-2">Requirement Name</th>
                                  <th class="py-2">Cost</th>
                                  <th class="py-2">Quantity</th>
                              </tr>
                          </thead>
                          <tbody>
                              {{-- @foreach(json_decode($latestEvent->requirements) as $requirement)
                                  <tr>
                                      <td class="py-2">{{ $requirement->requirement_name }}</td>
                                      <td class="py-2">${{ number_format($requirement->cost, 2) }}</td>
                                      <td class="py-2">{{ $requirement->quantity }}</td>
                                  </tr>
                              @endforeach --}}
                          </tbody>
                      </table>
                  </div>
              @endforeach
          @else
              <p>No latest events found.</p>
          @endif
      </div>
  
  </div>
  
</body>
</html>