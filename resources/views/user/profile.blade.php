@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">My Profile</h1>

    <!-- Avatar Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Profile Picture</h2>
        
        <div class="flex items-center space-x-6">
            <div class="relative">
                <img class="h-24 w-24 rounded-full object-cover border-4 border-gray-100" 
                     src="{{ user()->getAvatarUrl() }}" 
                     alt="{{ user()->name }}">
            </div>
            
            <div class="flex-1">
                <form method="POST" action="{{ route('user.profile.avatar') }}" enctype="multipart/form-data" id="avatarForm">
                    @csrf
                    <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*" onchange="this.form.submit()">
                    <label for="avatar" class="btn-primary cursor-pointer inline-block">
                        <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Upload New Photo
                    </label>
                </form>
                
                @if(user()->avatar)
                    <form method="POST" action="{{ route('user.profile.avatar.delete') }}" class="inline-block ml-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-600 hover:text-red-700 font-medium transition duration-150">
                            Remove Photo
                        </button>
                    </form>
                @endif
                
                <p class="text-xs text-gray-500 mt-2">JPG, PNG or GIF. Max size 2MB.</p>
            </div>
        </div>
    </div>

    <!-- Profile Info -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Profile Information</h2>
        
        <form method="POST" action="{{ route('user.profile.update') }}">
            @csrf
            
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ user()->name }}"
                    required
                    class="input-field w-full"
                >
            </div>
            
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address
                </label>
                <input 
                    type="email" 
                    value="{{ user()->email }}"
                    disabled
                    class="input-field w-full bg-gray-50 cursor-not-allowed"
                >
                <div class="flex items-start mt-2">
                    <svg class="w-4 h-4 text-gray-400 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-xs text-gray-500">
                        Email and password cannot be changed by yourself. Please contact admin or customer service for assistance.
                    </p>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>
                <input 
                    type="password" 
                    value="••••••••••"
                    disabled
                    class="input-field w-full bg-gray-50 cursor-not-allowed"
                >
                <div class="flex items-start mt-2">
                    <svg class="w-4 h-4 text-gray-400 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-xs text-gray-500">
                        For security reasons, password changes must be requested through admin or customer service.
                    </p>
                </div>
            </div>
            
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <button type="submit" class="btn-primary">
                    <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Stats -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Your Statistics</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600 mb-1">Total Actions</p>
                        <p class="text-3xl font-bold text-blue-700">{{ $totalActions }}</p>
                    </div>
                    <div class="bg-blue-200 rounded-full p-3">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6 border border-green-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-600 mb-1">Completed</p>
                        <p class="text-3xl font-bold text-green-700">{{ $completedActions }}</p>
                    </div>
                    <div class="bg-green-200 rounded-full p-3">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        @if($totalActions > 0)
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm font-medium text-gray-600">Completion Rate</p>
                <p class="text-sm font-semibold text-gray-900">{{ round(($completedActions / $totalActions) * 100) }}%</p>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full transition-all duration-500" 
                     style="width: {{ ($completedActions / $totalActions) * 100 }}%">
                </div>
            </div>
        </div>
        @endif
        
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="bg-gray-100 rounded-full p-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Member since</p>
                    <p class="text-base font-semibold text-gray-900">{{ user()->created_at->format('F j, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Help Section -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mt-6">
        <div class="flex items-start">
            <svg class="w-6 h-6 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <div>
                <h3 class="text-sm font-semibold text-blue-900 mb-1">Need Help?</h3>
                <p class="text-sm text-blue-700">
                    If you need to update your email or password, please contact our admin or customer service team for assistance.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection