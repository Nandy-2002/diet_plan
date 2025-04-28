<div class="pb-6">
    @if ($announcements->isEmpty())
        <div class="flex items-center justify-center p-6 bg-purple-200 dark:bg-purple-200 rounded-lg shadow-md">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-purple-600 dark:text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14.75V6m0 8.75h-3a1 1 0 000 2h6a1 1 0 000-2h-3zm3-8h.01M15 5.75A7.25 7.25 0 1117.25 12" />
                </svg>
                <h3 class="text-xl font-semibold mb-2 dark:text-grey">No Announcements</h3>
                <p class="text-gray-600 dark:text-white-300">It looks like there are currently no announcements to display. Please check back later!</p>
            </div>
        </div>
    @else
        @foreach ($announcements as $announcement)
        <div class="relative flex items-center justify-center p-6 bg-purple-200 dark:bg-gray-800 rounded-lg shadow-md mb-4">
            <!-- "All Users" label in the top right corner -->
            @if ($announcement->is_all_users)
                <span class="absolute top-2 right-2 px-2 py-1 bg-blue-500 dark:bg-blue-700 text-white text-xs rounded-lg">
                    All Users
                </span>
            @endif
        
            <div class="w-full">
                <!-- Title with expand/collapse functionality -->
                <div class="flex justify-between items-center cursor-pointer" onclick="toggleAnnouncement({{ $announcement->id }})">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                        {{ $announcement->title }}
                    </h3>
                    <svg id="icon-{{ $announcement->id }}" class="w-5 h-5 text-gray-800 dark:text-gray-100 transform transition-transform" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 10a1 1 0 012 0h6a1 1 0 110 2H7a1 1 0 01-2 0v-2z" clip-rule="evenodd"/>
                    </svg>
                </div>
        
                <!-- Collapsible description -->
                <div id="content-{{ $announcement->id }}" class="text-gray-700 dark:text-gray-300 mt-2 hidden">
                    <p>{{ $announcement->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
<script>
    function toggleAnnouncement(id) {
        const content = document.getElementById(`content-${id}`);
        const icon = document.getElementById(`icon-${id}`);
        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>