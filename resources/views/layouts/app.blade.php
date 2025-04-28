<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @livewireStyles
    <style>
      [x-cloak] {
      display: none;
    }
    </style>
    <style>
      /* Custom Scrollbar Styles */
      .custom-scrollbar::-webkit-scrollbar {
        width: 8px; /* Vertical scrollbar width */
        height: 8px; /* Horizontal scrollbar height */
      }

      .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1; /* Light background color for the scrollbar track */
      }

      .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #888; /* Scrollbar thumb color */
        border-radius: 10px;
        border: 2px solid transparent; /* Adds padding inside the thumb */
      }

      .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: #555; /* Darker color on hover */
      }
    </style>
    @yield('css')
  </head>
  <body>
    <div x-data="{ isSideMenuOpen: false, activeLink: 'dashboard' }" class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
      <aside class="z-20 hidden w-64 custom-scrollbar overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#"> NUTRITECH </a> @include('partials.menu')
        </div>
      </aside>
      <!-- Mobile sidebar -->
      <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-10 flex items-end bg-opacity-50 sm:items-center sm:justify-center"></div>
      <aside class="fixed inset-y-0 z-20 custom-scrollbar flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden" x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="isSideMenuOpen = false" @keydown.escape="isSideMenuOpen = false">
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#"> NUTRITECH </a> @include('partials.menu')
        </div>
      </aside>
      <!-- Rest of the page content -->
      <div class="flex flex-col flex-1 w-full"> @include('partials.header') <main class="h-full overflow-y-auto dark:darkcustom-scrollbar custom-scrollbar"><div class="p-4 bg-gray-100 dark:bg-gray-900 min-h-screen"> @yield('content')@include('partials.sweetalert') @include('partials.footer')</div>  </main>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      function togglePasswordVisibility(button) {
          const passwordInput = button.previousElementSibling;
          const toggleIcon = button.querySelector('i');
  
          if (passwordInput.type === 'password') {
              passwordInput.type = 'text';
              toggleIcon.classList.remove('fa-eye-slash');
              toggleIcon.classList.add('fa-eye'); // Change to eye icon
          } else {
              passwordInput.type = 'password';
              toggleIcon.classList.remove('fa-eye');
              toggleIcon.classList.add('fa-eye-slash'); // Change to eye-slash icon
          }
      }
  </script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
     @yield('scripts')
     @livewireScripts
  </body>
</html>