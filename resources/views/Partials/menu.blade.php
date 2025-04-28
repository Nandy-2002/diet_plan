<style>
    [x-cloak] {
    display: none !important;
}
</style>
<div x-cloak>
    <ul class="mt-6">
        <li class="relative px-6 py-3" @click="activeLink = 'dashboard_page'">
            <span x-show="activeLink === 'dashboard_page' || '{{ request()->routeIs('dashboard') }}'" class="absolute inset-y-0 left-0 w-1 bg-green-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            <a :class="{'text-gray-800 dark:text-white': activeLink === 'dashboard_page' || '{{ request()->routeIs('dashboard') }}'}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-white" href="{{ route('dashboard') }}">
                <i class="fas fa-home w-5 h-5" aria-hidden="true"></i>
                <span class="ml-4">dashboard</span>
            </a>
        </li>
    </ul>
    
    @if (hasPermission('manage_user'))
        <ul>
            <li class="relative px-6 py-3" @click="activeLink = 'Manage_User'">
                <span x-show="activeLink === 'Manage_User' || '{{ request()->routeIs('admin.users') }}'" class="absolute inset-y-0 left-0 w-1 bg-green-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <a :class="{'text-gray-800 dark:text-white': activeLink === 'Manage_User' || '{{ request()->routeIs('admin.users') }}'}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-white" href="{{ route('admin.users') }}">
                    <i class="fas fa-users w-5 h-5" aria-hidden="true"></i>
                    <span class="ml-4">Manage User</span>
                </a>
            </li>
        </ul>
    @endif
    
    @if (hasPermission('manage_roles'))
        <ul>
            <li class="relative px-6 py-3" @click="activeLink = 'manage_Roles'">
                <span x-show="activeLink === 'manage_Roles' || '{{ request()->routeIs('admin.roles') }}'" class="absolute inset-y-0 left-0 w-1 bg-green-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <a :class="{'text-gray-800 dark:text-white': activeLink === 'manage_Roles' || '{{ request()->routeIs('admin.roles') }}'}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-white" href="{{ route('admin.roles') }}">
                    <i class="fas fa-user-cog w-5 h-5" aria-hidden="true"></i>
                    <span class="ml-4">Manage Roles</span>
                </a>
            </li>
        </ul>
    @endif
    
    @if (hasPermission('prdections'))
        <ul>
            <li class="relative px-6 py-3" @click="activeLink = 'prdections'">
                <span x-show="activeLink === 'prdections' || '{{ request()->routeIs('admin.prdections') }}'" class="absolute inset-y-0 left-0 w-1 bg-green-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <a :class="{'text-gray-800 dark:text-white': activeLink === 'prdections' || '{{ request()->routeIs('admin.prdections') }}'}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-white" href="{{ route('admin.prdections') }}">
                    <i class="fas fa-chart-line w-5 h-5" aria-hidden="true"></i> <!-- Updated Icon for 'Predict' -->
                    <span class="ml-4">Predict</span>
                </a>
            </li>
        </ul>
    @endif

    @if (hasPermission('prdections'))
        <ul>
            <li class="relative px-6 py-3" @click="activeLink = 'prdections'">
                <span x-show="activeLink === 'prdections' || '{{ request()->routeIs('admin.collaboration.view') }}'" class="absolute inset-y-0 left-0 w-1 bg-green-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <a :class="{'text-gray-800 dark:text-white': activeLink === 'prdections' || '{{ request()->routeIs('admin.collaboration.view') }}'}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-white" href="{{ route('admin.collaboration.view') }}">
                    <i class="fas fa-users w-5 h-5" aria-hidden="true"></i> <!-- Updated Icon for 'Collaboration' -->
                    <span class="ml-4">Collaboration</span>
                </a>
            </li>
        </ul>
    @endif 

    @if (hasPermission('prdections'))
        <ul>
            <li class="relative px-6 py-3" @click="activeLink = 'prdections'">
                <span x-show="activeLink === 'prdections' || '{{ request()->routeIs('admin.weeklypredict') }}'" class="absolute inset-y-0 left-0 w-1 bg-green-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <a :class="{'text-gray-800 dark:text-white': activeLink === 'prdections' || '{{ request()->routeIs('admin.weeklypredict') }}'}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-white" href="{{ route('admin.weeklypredict') }}">
                    <i class="fas fa-calendar-week w-5 h-5" aria-hidden="true"></i> <!-- Updated Icon for 'Weekly Predict' -->
                    <span class="ml-4">Weekly Predict</span>
                </a>
            </li>
        </ul>
    @endif

</div>