@extends('layouts.app')

@section('title', 'Growth Log')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <!-- Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex items-center gap-3 sm:gap-4 mb-2">
            <a href="{{ route('growth.index') }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors text-sm sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="hidden sm:inline">Back to Growth Logs</span>
                <span class="sm:hidden">Back</span>
            </a>
        </div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Growth Log Details</h1>
        <p class="text-sm sm:text-base text-gray-600 mt-1">Your reflection from {{ $log->log_date->format('F j, Y') }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Mood Header -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-5 sm:px-8 py-6 sm:py-8">
            <div class="flex items-center gap-4 sm:gap-6">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white rounded-2xl flex items-center justify-center shadow-md flex-shrink-0">
                    <span class="text-4xl sm:text-5xl">{{ $log->getMoodEmoji() }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-1 truncate">{{ $log->getMoodLabel() }}</h2>
                    <div class="flex items-center text-gray-600 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium truncate">{{ $log->log_date->format('l, F j, Y') }}</span>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">{{ $log->log_date->diffForHumans() }}</p>
                </div>
            </div>
        </div>

        <!-- Reflection Content -->
        <div class="px-5 sm:px-8 py-6 sm:py-8">
            @if($log->reflection)
                <div class="mb-6">
                    <h3 class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3 flex items-center">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Reflection
                    </h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed whitespace-pre-line">{{ $log->reflection }}</p>
                    </div>
                </div>
            @else
                <div class="text-center py-6 sm:py-8">
                    <div class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 bg-gray-100 rounded-full mb-4">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium text-sm sm:text-base">No reflection added</p>
                    <p class="text-gray-400 text-xs sm:text-sm mt-1">You can add reflections when creating a log</p>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 px-5 sm:px-8 py-3 sm:py-4 border-t border-gray-200">
            <div class="text-xs text-gray-500 text-center">
                Created {{ $log->created_at->format('M d, Y \a\t g:i A') }}
            </div>
        </div>
    </div>
</div>
@endsection