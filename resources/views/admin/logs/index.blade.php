@extends('layouts.app')

@section('content')
<div class="container px-5 mx-auto m-5">
    <div class="card bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <div class="p-4">
            <div class="container mx-auto p-6">
                <h2 class="text-2xl font-bold dark:text-white text-left mb-8">Logs</h2>
                @if($logs->isEmpty())
                    <div class="py-4 text-center text-gray-500 dark:text-gray-400">
                        <p class="bg-blue-100 border-l-4 border-blue-700 rounded-md p-4 mb-4 text-sm text-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            No Logs found.
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto custom-scrollbar mb-5 pt-4">
                        <table class="min-w-full table-auto bg-white border border-gray-300 rounded-lg shadow-md data-table dark:bg-gray-800">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr class="text-left">
                                    <th class="px-4 py-2 border border-gray-300 text-gray-800 dark:text-gray-300 dark:border-gray-600">Date/Time</th>
                                    <th class="px-4 py-2 border border-gray-300 text-gray-800 dark:text-gray-300 dark:border-gray-600">Log Type</th>
                                    <th class="px-4 py-2 border border-gray-300 text-gray-800 dark:text-gray-300 dark:border-gray-600">Status</th>
                                    <th class="px-4 py-2 border border-gray-300 text-gray-800 dark:text-gray-300 dark:border-gray-600">Message</th>
                                    <th class="px-4 py-2 border border-gray-300 text-gray-800 dark:text-gray-300 dark:border-gray-600">Icon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 {{ $log->status == 'success' ? 'bg-green-100 dark:bg-green-900' : ($log->status == 'error' ? 'bg-red-100 dark:bg-red-900' : 'bg-yellow-100 dark:bg-yellow-900') }}">
                                        <td class="px-4 py-2 border border-gray-300 dark:text-white dark:border-gray-600 whitespace-nowrap">{{ $log->created_at->format('d-m-y H:i:s') }}</td>
                                        <td class="px-4 py-2 border border-gray-300 dark:text-white dark:border-gray-600 whitespace-nowrap">
                                            @if($log->status == 'success')
                                                <i class="fas fa-check-circle text-green-600"></i> <!-- Success Icon -->
                                            @elseif($log->status == 'error')
                                                <i class="fas fa-times-circle text-red-600"></i> <!-- Error Icon -->
                                            @elseif($log->status == 'warning')
                                                <i class="fas fa-exclamation-circle text-yellow-600"></i> <!-- Warning Icon -->
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 border border-gray-300 dark:text-white dark:border-gray-600 whitespace-nowrap">{{ ucfirst($log->status) }}</td>
                                        <td class="px-4 py-2 border border-gray-300 dark:text-white dark:border-gray-600">
                                            <div x-data="{ expanded: false }" @click="expanded = !expanded" class="cursor-pointer">
                                                <!-- Shortened message (visible initially) -->
                                                <span x-show="!expanded">
                                                    {{ Str::limit($log->message, 50) }}
                                                </span>
                                                <!-- Full message (visible when clicked) -->
                                                <span x-show="expanded">
                                                    {{ $log->message }}
                                                </span>
                                            </div>
                                        </td>                                                                               
                                        <td class="px-4 py-2 border border-gray-300 dark:text-white dark:border-gray-600"><i class="{{ $log->icon }}"></i></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection