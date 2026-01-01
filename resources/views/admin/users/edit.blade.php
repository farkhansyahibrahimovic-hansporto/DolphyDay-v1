@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-2">
            <a href="{{ route('admin.users.index') }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Users
            </a>
        </div>
        <h1 class="text-3xl font-bold text-gray-900">Edit User</h1>
        <p class="text-gray-600 mt-1">Update {{ $user->name }}'s information</p>
    </div>

    <!-- Profile Information Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-8 py-6">
            <h2 class="text-xl font-semibold text-white">Profile Information</h2>
            <p class="text-blue-100 text-sm mt-1">Update user's basic profile details</p>
        </div>

        <!-- Form Content -->
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')
            
            <!-- Avatar Upload Section -->
            <div class="mb-8 pb-8 border-b border-gray-200">
                <label class="block text-sm font-semibold text-gray-700 mb-4">
                    Profile Picture
                </label>
                <div class="flex items-start gap-6">
                    <!-- Avatar Preview -->
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img id="avatarPreview" 
                                 class="h-32 w-32 rounded-full object-cover ring-4 ring-gray-200 shadow-lg" 
                                 src="{{ $user->getAvatarUrl() }}" 
                                 alt="{{ $user->name }}">
                            <button type="button"
                                    onclick="document.getElementById('avatarInput').click()"
                                    class="absolute bottom-0 right-0 w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center ring-4 ring-white hover:bg-blue-700 transition-colors shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Upload Info -->
                    <div class="flex-1">
                        <input type="file" 
                               id="avatarInput" 
                               name="avatar" 
                               accept="image/*" 
                               class="hidden"
                               onchange="previewAvatar(event)">
                        
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Change Photo</h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Upload a new profile picture or keep the current one
                        </p>
                        
                        <button type="button" 
                                onclick="document.getElementById('avatarInput').click()"
                                class="inline-flex items-center px-4 py-2.5 bg-white border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            Choose New Image
                        </button>
                        
                        <p class="text-xs text-gray-500 mt-3">
                            <span class="font-medium">Supported formats:</span> JPG, PNG, GIF<br>
                            <span class="font-medium">Maximum size:</span> 2MB
                        </p>

                        @error('avatar')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name', $user->name) }}"
                            required
                            class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                            placeholder="Enter full name"
                        >
                    </div>
                    @error('name')
                        <p class="mt-1.5 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                            placeholder="user@example.com"
                        >
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                <button 
                    type="submit"
                    class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Profile
                </button>
            </div>
        </form>
    </div>

    <!-- Change Password Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 px-8 py-6">
            <h2 class="text-xl font-semibold text-white">Change Password</h2>
            <p class="text-green-100 text-sm mt-1">Update user's password (leave blank to keep current)</p>
        </div>

        <!-- Form Content -->
        <form method="POST" action="{{ route('admin.users.update-password', $user->id) }}" class="p-8">
            @csrf
            @method('PUT')
            
            <!-- Security Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        New Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="w-full pl-11 pr-12 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                            placeholder="Enter new password (min 8 characters)"
                        >
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('password', 'eyeOffPassword', 'eyeOnPassword')"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                        >
                            <svg id="eyeOffPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                            <svg id="eyeOnPassword" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        Confirm New Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            class="w-full pl-11 pr-12 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                            placeholder="Confirm new password"
                        >
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('password_confirmation', 'eyeOffConfirm', 'eyeOnConfirm')"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                        >
                            <svg id="eyeOffConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                            <svg id="eyeOnConfirm" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            <div class="flex items-center justify-end pt-6 border-t border-gray-200">
                <button 
                    type="submit"
                    class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <!-- Danger Zone Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border-2 border-red-200">
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 px-8 py-6">
            <h2 class="text-xl font-semibold text-white">Danger Zone</h2>
            <p class="text-red-100 text-sm mt-1">Irreversible actions - proceed with caution</p>
        </div>

        <!-- Content -->
        <div class="p-8">
            <div class="flex items-start justify-between gap-6">
                <div class="flex-1">
                    <h3 class="text-base font-semibold text-gray-900 mb-2">Delete User Account</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Permanently delete this user account and all associated data. This action cannot be undone and will remove all micro actions, growth logs, and other related information.
                    </p>
                </div>
                <button 
                    onclick="confirmDelete()"
                    class="flex-shrink-0 inline-flex items-center px-5 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-all shadow-lg hover:shadow-xl">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete User
                </button>
            </div>

            <!-- Hidden Delete Form -->
            <form id="delete-form" 
                  action="{{ route('admin.users.destroy', $user->id) }}" 
                  method="POST" 
                  class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm" 
         id="deleteBackdrop"
         style="opacity: 0; transition: opacity 0.3s ease;"></div>
    
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div id="deleteModalContent" 
             class="bg-white rounded-2xl shadow-2xl max-w-md w-full"
             style="transform: scale(0.95); opacity: 0; transition: all 0.3s ease;">
            <div class="p-8">
                <!-- Icon -->
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                
                <!-- Content -->
                <h3 class="text-xl font-bold text-gray-900 text-center mb-3">Delete User Account</h3>
                <p class="text-sm text-gray-600 text-center mb-8 leading-relaxed">
                    Are you sure you want to delete <strong class="text-gray-900">{{ $user->name }}</strong>? 
                    This action cannot be undone and will permanently remove all associated data.
                </p>
                
                <!-- Buttons -->
                <div class="flex gap-3">
                    <button type="button" 
                            id="cancelDeleteBtn"
                            class="flex-1 px-5 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-all">
                        Cancel
                    </button>
                    <button type="button" 
                            id="confirmDeleteBtn"
                            class="flex-1 px-5 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition-all shadow-lg hover:shadow-xl">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Avatar Preview
    function previewAvatar(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Toggle Password Visibility
    function togglePasswordVisibility(inputId, eyeOffId, eyeOnId) {
        const input = document.getElementById(inputId);
        const eyeOff = document.getElementById(eyeOffId);
        const eyeOn = document.getElementById(eyeOnId);
        
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        eyeOff.classList.toggle('hidden');
        eyeOn.classList.toggle('hidden');
    }

    // Delete Modal Functions
    function confirmDelete() {
        showModal();
    }

    function showModal() {
        const modal = document.getElementById('deleteModal');
        const backdrop = document.getElementById('deleteBackdrop');
        const content = document.getElementById('deleteModalContent');
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            backdrop.style.opacity = '1';
            content.style.transform = 'scale(1)';
            content.style.opacity = '1';
        }, 10);
    }

    function hideModal() {
        const modal = document.getElementById('deleteModal');
        const backdrop = document.getElementById('deleteBackdrop');
        const content = document.getElementById('deleteModalContent');
        
        backdrop.style.opacity = '0';
        content.style.transform = 'scale(0.95)';
        content.style.opacity = '0';
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const cancelBtn = document.getElementById('cancelDeleteBtn');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        const backdrop = document.getElementById('deleteBackdrop');

        // Cancel button
        cancelBtn.addEventListener('click', hideModal);

        // Backdrop click
        backdrop.addEventListener('click', hideModal);

        // Confirm delete
        confirmBtn.addEventListener('click', function() {
            document.getElementById('delete-form').submit();
        });
    });
</script>
@endsection