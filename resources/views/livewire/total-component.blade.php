<div class="grid gap-6 mb-8 md:grid-cols-3 xl:grid-cols-3 ">
    <!-- Card 1: Total Users -->
    <div class="flex items-center p-4 bg-indigo-50 rounded-lg shadow-md shadow-purple-500 dark:bg-gray-800 dark:bg-opacity-40 dark:shadow-purple-700">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <i class="fas fa-users w-6 h-5 text-center" aria-hidden="true"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $totalUsers }}</p>
        </div>
    </div>

    <!-- Card 2: Income -->
    <div class="flex items-center p-4 bg-green-50 rounded-lg shadow-md shadow-purple-500 dark:bg-gray-800 dark:bg-opacity-40 dark:shadow-purple-700">
        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-500 dark:bg-green-100">
            <i class="fas fa-check-circle w-6 h-5 text-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Precaution Suggestions</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">4000+</p>
        </div>
    </div>

    <!-- Card 3: Expenses -->
    <div class="flex items-center p-4 bg-red-50 rounded-lg shadow-md shadow-purple-500 dark:bg-gray-800 dark:bg-opacity-40 dark:shadow-purple-700">
        <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-orange-500 dark:bg-red-100">
            <i class="fas fa-virus w-6 h-5 text-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Disease Diet plan</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">1000+</p>
        </div>
    </div>

</div>