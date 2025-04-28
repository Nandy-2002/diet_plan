<div x-data="{ open: false }" class="relative" >
    <button @click="open = !open" class="relative align-middle rounded-md focus:outline-none">
        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
        </svg>
        @if (count($notifications) > 0)
            <span class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full"></span>
        @endif
    </button>

    <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 w-96 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:bg-gray-800 dark:border-gray-700" style="display: none;">
        <div class="max-h-80 overflow-y-auto custom-scrollbar">
            @forelse ($notifications as $notification)
                <div class="flex items-center p-4 mb-4 bg-white rounded-lg shadow-md dark:text-white-300 dark:bg-gray-700 dark:border-gray-700">
                    <div class="flex-grow">
                        <div class="font-semibold">{{ $notification->message }}</div>
                        <div class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                    <button wire:click="deleteNotification({{ $notification->id }})" class="flex-shrink-0 w-5 h-5 text-purple-600 hover:text-blue-800">
                        <i class="fas fa-times" aria-label="Delete notification"></i>
                    </button>     
                </div>
            @empty
                <div class="p-4 text-center text-gray-500 bg-gray-100 rounded-lg dark:text-gray-300 dark:bg-gray-800">
                    <p>No notifications found at the moment.</p>
                </div>            
            @endforelse
        </div>
        @if(count($notifications) > 0)
        <button 
            wire:click="clearAll" 
            class="w-full block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 
                dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-700">
            Clear All
        </button>    
        @endif
    </div>
</div>