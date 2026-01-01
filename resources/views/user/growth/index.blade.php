@extends('layouts.app')

@section('title', 'Growth Logs')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <!-- Success Alert -->
    @if(session('success'))
        <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg shadow-md overflow-hidden animate-fade-in">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <h3 class="text-sm font-semibold text-green-800">Success!</h3>
                        <p class="mt-1 text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.parentElement.remove()" 
                            class="flex-shrink-0 ml-3 text-green-500 hover:text-green-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Error Alert -->
    @if(session('error'))
        <div class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-lg shadow-md overflow-hidden animate-fade-in">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <h3 class="text-sm font-semibold text-red-800">Error!</h3>
                        <p class="mt-1 text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.parentElement.remove()" 
                            class="flex-shrink-0 ml-3 text-red-500 hover:text-red-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Growth Logs</h1>
            <p class="text-sm sm:text-base text-gray-600 mt-1">Track your personal growth journey</p>
        </div>
        <a href="{{ route('growth.create') }}" 
           class="inline-flex items-center justify-center px-4 sm:px-5 py-2.5 sm:py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg text-sm sm:text-base">
            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            <span class="whitespace-nowrap">New Log</span>
        </a>
    </div>

    <!-- Mood Filter -->
    <div class="bg-white rounded-xl shadow-lg p-3 sm:p-4 mb-6">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('growth.index') }}" 
               class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors text-sm {{ !$mood ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All Moods
            </a>
            <a href="{{ route('growth.index', ['mood' => 'peaceful']) }}" 
               class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors text-sm {{ $mood === 'peaceful' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <span class="mr-1.5">😌</span> Peaceful
            </a>
            <a href="{{ route('growth.index', ['mood' => 'hopeful']) }}" 
               class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors text-sm {{ $mood === 'hopeful' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <span class="mr-1.5">🌱</span> Hopeful
            </a>
            <a href="{{ route('growth.index', ['mood' => 'content']) }}" 
               class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors text-sm {{ $mood === 'content' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <span class="mr-1.5">😊</span> Content
            </a>
            <a href="{{ route('growth.index', ['mood' => 'growing']) }}" 
               class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors text-sm {{ $mood === 'growing' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <span class="mr-1.5">🌟</span> Growing
            </a>
            <a href="{{ route('growth.index', ['mood' => 'struggling']) }}" 
               class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors text-sm {{ $mood === 'struggling' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <span class="mr-1.5">💭</span> Struggling
            </a>
        </div>
    </div>

    <!-- Logs Timeline -->
    <div class="space-y-4">
        @if($logs->isEmpty())
            <div class="bg-white rounded-xl shadow-lg p-8 sm:p-12 text-center">
                <div class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 bg-blue-50 rounded-full mb-4">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <p class="text-gray-500 font-medium mb-2 text-sm sm:text-base">No growth logs yet</p>
                <p class="text-gray-400 text-xs sm:text-sm mb-4">Start your reflection journey today</p>
                <a href="{{ route('growth.create') }}" 
                   class="inline-flex items-center px-4 sm:px-5 py-2 sm:py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors shadow-md text-sm sm:text-base">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Create First Log
                </a>
            </div>
        @else
            @foreach($logs as $log)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="p-4 sm:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                            <div class="flex items-start gap-3 sm:gap-4 flex-1">
                                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="text-2xl sm:text-3xl">{{ $log->getMoodEmoji() }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-semibold text-gray-900 text-base sm:text-lg">{{ $log->getMoodLabel() }}</h3>
                                    <div class="flex items-center text-xs sm:text-sm text-gray-500 mt-1">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="truncate">{{ $log->log_date->format('F j, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('growth.show', $log->id) }}" 
                               class="inline-flex items-center justify-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors font-medium text-xs sm:text-sm whitespace-nowrap">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View
                            </a>
                        </div>
                        
                        @if($log->reflection)
                            <div class="pt-4 mt-4 border-t border-gray-200">
                                <p class="text-sm sm:text-base text-gray-700 whitespace-pre-line line-clamp-3">{{ $log->reflection }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            
            <!-- Pagination -->
            @if($logs->hasPages())
                <div class="bg-white rounded-xl shadow-lg px-4 sm:px-6 py-4">
                    {{ $logs->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}
</style>
@endsection