@extends('layouts.admin')

@section('title', 'User Activity')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-600 hover:text-blue-700">
            ← Back to User Details
        </a>
    </div>

    <h1 class="text-3xl font-bold text-gray-900 mb-2">Activity Log</h1>
    <p class="text-gray-600 mb-6">{{ $user->name }}</p>

    <!-- Activity List -->
    <div class="bg-white rounded-lg shadow">
        <div class="divide-y divide-gray-200">
            @forelse($actions as $action)
                <div class="p-6 hover:bg-gray-50">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <span class="w-2 h-2 rounded-full {{ $action->is_completed ? 'bg-green-500' : 'bg-gray-400' }} mr-2"></span>
                                <h3 class="font-medium text-gray-900">{{ $action->title }}</h3>
                            </div>
                            @if($action->description)
                                <p class="text-sm text-gray-600 ml-4">{{ $action->description }}</p>
                            @endif
                            <div class="flex items-center mt-2 ml-4 text-xs text-gray-500 space-x-4">
                                <span>Date: {{ $action->action_date->format('M d, Y') }}</span>
                                <span>Created: {{ $action->created_at->format('M d, Y H:i') }}</span>
                                @if($action->is_completed)
                                    <span>Completed: {{ $action->completed_at->format('M d, Y H:i') }}</span>
                                @endif
                            </div>
                        </div>
                        <span class="ml-4 px-3 py-1 text-xs rounded-full {{ $action->is_completed ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $action->is_completed ? 'Completed' : 'Pending' }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-gray-500">
                    No activity found
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $actions->links() }}
        </div>
    </div>
</div>
@endsection