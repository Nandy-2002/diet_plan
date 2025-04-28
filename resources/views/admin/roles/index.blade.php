@extends('layouts.app')

@section('title', 'Manage Roles')

@section('scripts')
    <script>
    $(document).ready(function() {
        $('.permissions-select').select2({
            placeholder: "Select permissions",
            tags: true,
            width: '100%' // For full-width display
        });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="card bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <div class="container mx-auto px-4 py-4">
            <h1 class="pb-4 pt-4 text-2xl dark:text-white font-semibold mb-4">Manage Roles</h1>
            <div class="overflow-x-auto custom-scrollbar">
                <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-left">
                            <th class="py-3 px-6 text-sm font-medium text-gray-700 dark:text-gray-200">User Name</th>
                            <th class="py-3 px-6 text-sm font-medium text-gray-700 dark:text-gray-200">Permission</th>
                            <th class="py-3 px-6 text-sm font-medium text-gray-700 dark:text-gray-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                          <tr class="border-t hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="py-4 px-6 text-gray-900 dark:text-gray-200">{{ $user->name }}</td>
                                <td class="py-4 px-6 text-gray-900 dark:text-gray-200" x-data="{ showAll: false }">
                                    @php
                                        $permissions = json_decode($user->role->permission_array); // Decode the JSON string
                                    @endphp
                                
                                    <div @click="showAll = !showAll" class="cursor-pointer">
                                        <template x-if="!showAll">
                                            <div>
                                                <!-- Show only the first few permissions -->
                                                @foreach(array_slice($permissions, 0, 3) as $permission)
                                                    <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">{{ $permission }}</span>
                                                @endforeach
                                                {{-- <!-- Indicate that the user can click to show all -->
                                                <span class="text-indigo-600 text-xs underline mt-1">... (click to see all)</span> --}}
                                            </div>
                                        </template>
                                
                                        <template x-if="showAll">
                                            <div>
                                                <!-- Show all permissions -->
                                                @foreach($permissions as $permission)
                                                    <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">{{ $permission }}</span>
                                                @endforeach
                                            </div>
                                        </template>
                                    </div>
                                
                                    <template x-if="!permissions || (!is_array($permissions) && !is_object($permissions))">
                                        <span>No permissions available</span>
                                    </template>
                                </td>                                                                                                        
                                <td class="py-4 px-6">
                                    <div x-data="{ isModalOpen: false, permissionArray: [] }">
                                        <button
                                        @click="isModalOpen = true; permissionArray = {{ json_encode($user->role->permission_array) }}"
                                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                        >
                                        Edit
                                        </button>
                                    
                                        <!-- Modal -->
                                        <div
                                        x-show="isModalOpen"
                                        x-cloak
                                        x-transition:enter="transition ease-out duration-150"
                                        x-transition:enter-start="opacity-0"
                                        x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        class="fixed inset-0 z-30 flex items-center justify-center bg-black bg-opacity-50 sm:items-center sm:justify-center"
                                        >
                                        <div
                                            @click.away="isModalOpen = false"
                                            @keydown.escape.window="isModalOpen = false"
                                            class="w-full px-6 py-4 overflow-hidden bg-white rounded-lg dark:bg-gray-800 sm:m-4 sm:max-w-xl"
                                            role="dialog"
                                        >
                                            <header class="flex justify-end">
                                                <button
                                                    class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover:text-gray-700"
                                                    aria-label="close"
                                                    @click="isModalOpen = false"
                                                >
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                                                        <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </header>
                                            <div class="mt-4 mb-6">
                                                <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                                                    Edit Permissions for {{ $user->name }}
                                                </p>
                                                <form action="{{ route('admin.updateUserRole', $user->id) }}" method="POST">
                                                @csrf
                                                <div>
                                                    <label class="block mb-2 text-sm text-gray-700 dark:text-gray-300">Permissions</label>
                                                    <select class="permissions-select form-control" name="permission_array[]" class="form-control" multiple="multiple">
                                                        @foreach(\App\Constants\Permission::ADMIN_PERMISSIONS as $permission)
                                                            <option value="{{ $permission }}" 
                                                                @if(in_array($permission, (array) json_decode($user->role->permission_array))) selected @endif>
                                                                {{ $permission }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <footer class="flex justify-end mt-4 space-x-2">
                                                    <button @click="isModalOpen = false" type="button"
                                                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
                                                        Accept
                                                    </button>
                                                </footer>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </td>
                          </tr>
                      @endforeach
                  </tbody>          
                </table>
            </div>
        </div>
    </div>
</div>
@endsection