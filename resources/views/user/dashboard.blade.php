@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <!-- Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                    Welcome back, {{ user()->name }}
                </h1>
                <p class="text-gray-600 mt-2 flex items-center text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ now()->format('l, F j, Y') }}
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                <button onclick="openModal('microActionModal')" 
                        class="flex items-center justify-center gap-2 px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors font-medium text-sm">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="whitespace-nowrap">About Micro Actions</span>
                </button>
                <button onclick="openModal('growthLogModal')" 
                        class="flex items-center justify-center gap-2 px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors font-medium text-sm">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="whitespace-nowrap">About Growth Logs</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <!-- Today's Actions -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-5 sm:p-6 text-white">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="p-2.5 sm:p-3 bg-white/20 rounded-lg backdrop-blur-sm">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-xs sm:text-sm font-medium text-blue-100 mb-1">Today's Actions</h3>
            <p class="text-3xl sm:text-4xl font-bold">{{ $todayActions->count() }}</p>
        </div>

        <!-- Weekly Progress -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl shadow-lg p-5 sm:p-6 text-white">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="p-2.5 sm:p-3 bg-white/20 rounded-lg backdrop-blur-sm">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-xs sm:text-sm font-medium text-blue-100 mb-1">This Week</h3>
            <p class="text-3xl sm:text-4xl font-bold">
                {{ $weeklyCompleted }}<span class="text-xl sm:text-2xl text-blue-200">/{{ $weeklyTotal }}</span>
            </p>
            <p class="text-xs sm:text-sm text-blue-100 mt-1">completed</p>
        </div>

        <!-- Growth Logs -->
        <div class="bg-gradient-to-br from-blue-700 to-blue-800 rounded-xl shadow-lg p-5 sm:p-6 text-white sm:col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="p-2.5 sm:p-3 bg-white/20 rounded-lg backdrop-blur-sm">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-xs sm:text-sm font-medium text-blue-100 mb-1">Growth Logs</h3>
            <p class="text-3xl sm:text-4xl font-bold">{{ $recentLogs->count() }}</p>
            <p class="text-xs sm:text-sm text-blue-100 mt-1">recent entries</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <!-- Micro Actions Quick Access -->
        <a href="{{ route('micro-actions.index') }}" 
           class="group bg-white rounded-xl shadow-lg p-5 sm:p-6 hover:shadow-xl transition-all border-2 border-transparent hover:border-blue-500">
            <div class="flex items-center justify-between">
                <div class="flex-1 min-w-0 mr-3">
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors truncate">
                        Manage Actions
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">View and organize your micro actions</p>
                </div>
                <div class="flex-shrink-0 p-2.5 sm:p-3 bg-blue-50 rounded-lg group-hover:bg-blue-100 transition-colors">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
        </a>

        <!-- Growth Logs Quick Access -->
        <a href="{{ route('growth.index') }}" 
           class="group bg-white rounded-xl shadow-lg p-5 sm:p-6 hover:shadow-xl transition-all border-2 border-transparent hover:border-blue-500">
            <div class="flex items-center justify-between">
                <div class="flex-1 min-w-0 mr-3">
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors truncate">
                        My Reflections
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">Read and write your growth logs</p>
                </div>
                <div class="flex-shrink-0 p-2.5 sm:p-3 bg-blue-50 rounded-lg group-hover:bg-blue-100 transition-colors">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
        </a>
    </div>

    <!-- Motivational Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-5 sm:p-6 border border-blue-200">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="flex-shrink-0 w-9 h-9 sm:w-10 sm:h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">Small Steps Matter</h4>
                    <p class="text-xs sm:text-sm text-gray-700">Every action you take today builds the future you want tomorrow.</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-5 sm:p-6 border border-blue-200">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="flex-shrink-0 w-9 h-9 sm:w-10 sm:h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">Progress Over Perfection</h4>
                    <p class="text-xs sm:text-sm text-gray-700">Focus on moving forward, not on being flawless.</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-5 sm:p-6 border border-blue-200 md:col-span-2 lg:col-span-1">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="flex-shrink-0 w-9 h-9 sm:w-10 sm:h-10 bg-blue-700 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">Reflect and Grow</h4>
                    <p class="text-xs sm:text-sm text-gray-700">Taking time to reflect helps you understand your journey better.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Micro Actions Guide -->
<div id="microActionModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-5 sm:p-6 rounded-t-2xl">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-xl sm:text-2xl font-bold text-white truncate">Micro Actions</h3>
                        <p class="text-blue-100 text-xs sm:text-sm">Small steps, big impact</p>
                    </div>
                </div>
                <button onclick="closeModal('microActionModal')" 
                        class="flex-shrink-0 text-white hover:bg-white/20 rounded-lg p-2 transition-colors">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-5 sm:p-6 space-y-5 sm:space-y-6">
            <!-- What is it? -->
            <div>
                <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <span class="w-7 h-7 sm:w-8 sm:h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xs sm:text-sm font-bold flex-shrink-0">1</span>
                    <span>What are Micro Actions?</span>
                </h4>
                <p class="text-sm sm:text-base text-gray-700 leading-relaxed">
                    Micro actions are small, actionable tasks that help you build positive habits and achieve your goals. Instead of overwhelming yourself with big goals, break them down into tiny, manageable steps that you can complete daily.
                </p>
            </div>

            <!-- How it works -->
            <div class="bg-blue-50 rounded-xl p-4 sm:p-5 border border-blue-200">
                <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <span class="w-7 h-7 sm:w-8 sm:h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xs sm:text-sm font-bold flex-shrink-0">2</span>
                    <span>How It Works</span>
                </h4>
                <div class="space-y-3">
                    <div class="flex items-start gap-2 sm:gap-3">
                        <div class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mt-0.5">✓</div>
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-900 text-sm sm:text-base">Create your actions</p>
                            <p class="text-xs sm:text-sm text-gray-600">Add small, specific tasks you want to accomplish</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2 sm:gap-3">
                        <div class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mt-0.5">✓</div>
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-900 text-sm sm:text-base">Set a schedule</p>
                            <p class="text-xs sm:text-sm text-gray-600">Choose daily, weekly, or custom frequency</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2 sm:gap-3">
                        <div class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mt-0.5">✓</div>
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-900 text-sm sm:text-base">Track your progress</p>
                            <p class="text-xs sm:text-sm text-gray-600">Mark actions as complete and build consistency</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Examples -->
            <div>
                <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <span class="w-7 h-7 sm:w-8 sm:h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xs sm:text-sm font-bold flex-shrink-0">3</span>
                    <span>Examples</span>
                </h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                        <p class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">💪 Health</p>
                        <p class="text-xs sm:text-sm text-gray-600">10 push-ups, drink 8 glasses of water</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                        <p class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">📚 Learning</p>
                        <p class="text-xs sm:text-sm text-gray-600">Read 10 pages, practice coding for 30 min</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                        <p class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">🧘 Mindfulness</p>
                        <p class="text-xs sm:text-sm text-gray-600">5-minute meditation, journal 1 gratitude</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                        <p class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">💼 Productivity</p>
                        <p class="text-xs sm:text-sm text-gray-600">Clear inbox, organize desk</p>
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 sm:p-5 border border-blue-200">
                <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    <span>Pro Tips</span>
                </h4>
                <ul class="space-y-2 text-xs sm:text-sm text-gray-700">
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600 font-bold flex-shrink-0">•</span>
                        <span>Start small - it's better to complete 3 tiny actions than fail at 1 big goal</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600 font-bold flex-shrink-0">•</span>
                        <span>Be specific - "Read 10 pages" is better than "Read more"</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600 font-bold flex-shrink-0">•</span>
                        <span>Build streaks - consistency matters more than intensity</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 p-4 sm:p-6 rounded-b-2xl border-t border-gray-200">
            <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                <button onclick="closeModal('microActionModal')" 
                        class="w-full sm:w-auto px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors text-sm sm:text-base">
                    Close
                </button>
                <a href="{{ route('micro-actions.index') }}" 
                   class="w-full sm:w-auto px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors text-center text-sm sm:text-base">
                    Get Started →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Growth Logs Guide -->
<div id="growthLogModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-5 sm:p-6 rounded-t-2xl">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-xl sm:text-2xl font-bold text-white truncate">Growth Logs</h3>
                        <p class="text-blue-100 text-xs sm:text-sm">Your personal reflection journal</p>
                    </div>
                </div>
                <button onclick="closeModal('growthLogModal')" 
                        class="flex-shrink-0 text-white hover:bg-white/20 rounded-lg p-2 transition-colors">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-5 sm:p-6 space-y-5 sm:space-y-6">
            <!-- What is it? -->
            <div>
                <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <span class="w-7 h-7 sm:w-8 sm:h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xs sm:text-sm font-bold flex-shrink-0">1</span>
                    <span>What are Growth Logs?</span>
                </h4>
                <p class="text-sm sm:text-base text-gray-700 leading-relaxed">
                    Growth logs are your personal reflection journal where you document your journey, insights, challenges, and victories. It's a space to understand yourself better, celebrate progress, and learn from experiences.
                </p>
            </div>

            <!-- Benefits -->
            <div class="bg-blue-50 rounded-xl p-4 sm:p-5 border border-blue-200">
                <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <span class="w-7 h-7 sm:w-8 sm:h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xs sm:text-sm font-bold flex-shrink-0">2</span>
                    <span>Why Keep Growth Logs?</span>
                </h4>
                <div class="space-y-3">
                    <div class="flex items-start gap-2 sm:gap-3">
                        <div class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mt-0.5">✓</div>
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-900 text-sm sm:text-base">Track your evolution</p>
                            <p class="text-xs sm:text-sm text-gray-600">See how far you've come and identify patterns</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2 sm:gap-3">
                        <div class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mt-0.5">✓</div>
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-900 text-sm sm:text-base">Gain clarity</p>
                            <p class="text-xs sm:text-sm text-gray-600">Writing helps organize thoughts and emotions</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2 sm:gap-3">
                        <div class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mt-0.5">✓</div>
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-900 text-sm sm:text-base">Learn from experience</p>
                            <p class="text-xs sm:text-sm text-gray-600">Reflect on what worked and what didn't</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2 sm:gap-3">
                        <div class="flex-shrink-0 w-5 h-5 sm:w-6 sm:h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mt-0.5">✓</div>
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-900 text-sm sm:text-base">Boost gratitude</p>
                            <p class="text-xs sm:text-sm text-gray-600">Acknowledge and appreciate your wins</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- What to write -->
            <div>
                <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <span class="w-7 h-7 sm:w-8 sm:h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xs sm:text-sm font-bold flex-shrink-0">3</span>
                    <span>What to Write About</span>
                </h4>
                <div class="grid grid-cols-1 gap-3">
                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                        <p class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">🎯 Daily Wins</p>
                        <p class="text-xs sm:text-sm text-gray-600">What went well today? What are you proud of?</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                        <p class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">💡 Lessons Learned</p>
                        <p class="text-xs sm:text-sm text-gray-600">What did you discover about yourself or others?</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                        <p class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">🚧 Challenges Faced</p>
                        <p class="text-xs sm:text-sm text-gray-600">What obstacles did you encounter? How did you handle them?</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                        <p class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">🙏 Gratitude Moments</p>
                        <p class="text-xs sm:text-sm text-gray-600">What are you thankful for today?</p>
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 sm:p-5 border border-blue-200">
                <h4 class="text-base sm:text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    <span>Reflection Tips</span>
                </h4>
                <ul class="space-y-2 text-xs sm:text-sm text-gray-700">
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600 font-bold flex-shrink-0">•</span>
                        <span>Write regularly - even a few sentences make a difference</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600 font-bold flex-shrink-0">•</span>
                        <span>Be honest with yourself - this is your private space</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600 font-bold flex-shrink-0">•</span>
                        <span>Don't judge your writing - focus on expressing yourself</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-600 font-bold flex-shrink-0">•</span>
                        <span>Review past entries to see your growth over time</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 p-4 sm:p-6 rounded-b-2xl border-t border-gray-200">
            <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                <button onclick="closeModal('growthLogModal')" 
                        class="w-full sm:w-auto px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors text-sm sm:text-base">
                    Close
                </button>
                <a href="{{ route('growth.index') }}" 
                   class="w-full sm:w-auto px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors text-center text-sm sm:text-base">
                    Start Writing →
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

// Close modal when clicking outside
['microActionModal', 'growthLogModal'].forEach(modalId => {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal(modalId);
            }
        });
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal('microActionModal');
        closeModal('growthLogModal');
    }
});
</script>
@endsection