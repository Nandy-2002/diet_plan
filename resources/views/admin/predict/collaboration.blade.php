@extends('layouts.app')

@section('title', 'Collaboration')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="card bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <div class="container mx-auto px-4 py-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
                    Collaboration - Disease: {{ ucfirst($diseaseName) }}
                </h2>
            
                <!-- Success message for feedback submission -->
                @if(session('success'))
                    <div class="alert alert-success bg-green-500 text-white p-3 rounded mt-4">
                        {{ session('success') }}
                    </div>
                @endif
            
                <!-- Feedback form -->
                <form action="{{ route('feedback.submit') }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="feedback" rows="4" class="form-control w-full p-3 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Share your experience..." required></textarea>
                    <button type="submit" class="btn btn-primary mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                        Submit Feedback
                    </button>
                </form>
            
                <h3 class="mt-4 text-lg font-semibold text-gray-800 dark:text-white">Feedback from others:</h3>
                
                @forelse($feedbacks as $feedback)
                    <div class="feedback mt-4 p-4 bg-white dark:bg-gray-800 rounded-md shadow-md">
                        <strong class="text-gray-800 dark:text-white">
                            {{ $feedback->user->name }} ({{ $feedback->created_at->diffForHumans() }}):
                        </strong>
                        <p class="text-gray-600 dark:text-gray-300">{{ $feedback->feedback }}</p>
                    </div>
                @empty
                    <p class="mt-4 text-gray-500 dark:text-gray-400">No feedback available for this disease yet. Be the first to share!</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
