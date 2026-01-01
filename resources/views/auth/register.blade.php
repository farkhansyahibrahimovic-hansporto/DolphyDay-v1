@extends('layouts.guest')

@section('title', 'Sign Up')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-8 bg-gray-50">
    <div class="w-full max-w-4xl">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid md:grid-cols-5">
                
                <!-- Image - Left Side -->
                <div class="md:col-span-2 bg-white p-8 flex items-center justify-center border-r border-gray-100">
                    <div class="text-center">
                        <div class="w-48 h-48 md:w-56 md:h-56 mx-auto mb-4">
                            <img 
                                src="{{ asset('image/Dolphin-Assets.png') }}" 
                                alt="Logo" 
                                class="w-full h-full object-contain"
                            >
                        </div>
                        <div>
                            <h2 class="text-blue-600 text-xl font-bold mb-1">Account Registration</h2>
                            <p class="text-gray-600 text-sm">Create a new account to get started</p>
                        </div>
                    </div>
                </div>
                
                <!-- Registration Form - Right Side -->
                <div class="md:col-span-3 bg-blue-600 p-8">
                    
                    <!-- Header -->
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-white mb-1">Create New Account</h1>
                        <p class="text-sm text-blue-100">Fill out the form to register</p>
                    </div>
                    
                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-5">
                            <ul class="text-sm space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-white mb-1.5">
                                Full Name
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name') }}"
                                placeholder="Enter your full name"
                                required
                                class="w-full px-4 py-2.5 text-sm bg-white text-gray-900 placeholder-gray-400 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"
                            >
                        </div>
                        
                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-white mb-1.5">
                                Email Address
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                value="{{ old('email') }}"
                                placeholder="name@example.com"
                                required
                                class="w-full px-4 py-2.5 text-sm bg-white text-gray-900 placeholder-gray-400 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"
                            >
                        </div>
                        
                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-white mb-1.5">
                                Password
                            </label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    placeholder="Minimum 8 characters"
                                    required
                                    class="w-full px-4 py-2.5 pr-11 text-sm bg-white text-gray-900 placeholder-gray-400 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"
                                >
                                <button 
                                    type="button" 
                                    id="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                                >
                                    <svg id="eyeOff" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                    <svg id="eyeOn" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Password Confirmation -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-sm font-medium text-white mb-1.5">
                                Confirm Password
                            </label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    id="password_confirmation" 
                                    placeholder="Re-enter your password"
                                    required
                                    class="w-full px-4 py-2.5 pr-11 text-sm bg-white text-gray-900 placeholder-gray-400 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"
                                >
                                <button 
                                    type="button" 
                                    id="toggleConfirmPassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
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
                        
                        <!-- Submit Button -->
                        <button 
                            type="button"
                            id="submitBtn"
                            class="w-full bg-white text-blue-600 py-2.5 rounded-lg font-semibold hover:bg-blue-50 transition-all shadow-md hover:shadow-lg"
                        >
                            Sign Up Now
                        </button>
                    </form>
                    
                    <!-- Login Link -->
                    <p class="text-center text-sm text-white mt-6">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-semibold hover:underline">
                            Sign in here
                        </a>
                    </p>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm transition-opacity duration-300" id="confirmBackdrop"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div id="confirmModalContent" class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300">
            <div class="p-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Confirm Registration</h3>
                <p class="text-sm text-gray-600 text-center mb-6">
                    Make sure the information you entered is correct. Proceed with registration?
                </p>
                <div class="flex gap-3">
                    <button type="button" id="cancelBtn" class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-all">
                        Cancel
                    </button>
                    <button type="button" id="confirmBtn" class="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                        Yes, Register
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Password Mismatch Modal -->
<div id="mismatchModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm transition-opacity duration-300" id="mismatchBackdrop"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div id="mismatchModalContent" class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300">
            <div class="p-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Passwords Don't Match</h3>
                <p class="text-sm text-gray-600 text-center mb-6">
                    Password and password confirmation do not match. Please check again.
                </p>
                <button type="button" id="mismatchBtn" class="w-full px-4 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-all shadow-md hover:shadow-lg">
                    Got It
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm transition-opacity duration-300" id="successBackdrop"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div id="successModalContent" class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300">
            <div class="p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Registration Successful</h3>
                <p class="text-sm text-gray-600 text-center mb-6">
                    Your account has been successfully created. Please login to continue.
                </p>
                <button type="button" id="successBtn" class="w-full px-4 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                    Go to Login Page
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 backdrop-blur-sm">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 border-4 border-blue-600 border-t-transparent rounded-full animate-spin mb-4"></div>
                <p class="text-gray-700 font-medium">Processing registration...</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password Toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOff = document.getElementById('eyeOff');
        const eyeOn = document.getElementById('eyeOn');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeOff.classList.toggle('hidden');
            eyeOn.classList.toggle('hidden');
        });
        
        // Confirm Password Toggle
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const eyeOffConfirm = document.getElementById('eyeOffConfirm');
        const eyeOnConfirm = document.getElementById('eyeOnConfirm');
        
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            eyeOffConfirm.classList.toggle('hidden');
            eyeOnConfirm.classList.toggle('hidden');
        });

        // Modal Elements
        const confirmModal = document.getElementById('confirmModal');
        const confirmBackdrop = document.getElementById('confirmBackdrop');
        const confirmModalContent = document.getElementById('confirmModalContent');
        const mismatchModal = document.getElementById('mismatchModal');
        const mismatchBackdrop = document.getElementById('mismatchBackdrop');
        const mismatchModalContent = document.getElementById('mismatchModalContent');
        const successModal = document.getElementById('successModal');
        const successBackdrop = document.getElementById('successBackdrop');
        const successModalContent = document.getElementById('successModalContent');
        const loadingOverlay = document.getElementById('loadingOverlay');
        const form = document.getElementById('registerForm');
        const submitBtn = document.getElementById('submitBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const confirmBtn = document.getElementById('confirmBtn');
        const mismatchBtn = document.getElementById('mismatchBtn');
        const successBtn = document.getElementById('successBtn');

        // Show Confirmation Modal
        submitBtn.addEventListener('click', function() {
            if (form.checkValidity()) {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                
                if (password !== confirmPassword) {
                    showModal(mismatchModal, mismatchBackdrop, mismatchModalContent);
                    return;
                }
                
                showModal(confirmModal, confirmBackdrop, confirmModalContent);
            } else {
                form.reportValidity();
            }
        });

        // Cancel Button
        cancelBtn.addEventListener('click', function() {
            hideModal(confirmModal, confirmBackdrop, confirmModalContent);
        });

        // Mismatch Button
        mismatchBtn.addEventListener('click', function() {
            hideModal(mismatchModal, mismatchBackdrop, mismatchModalContent);
        });

        // Confirm Button - Submit with AJAX
        confirmBtn.addEventListener('click', function() {
            hideModal(confirmModal, confirmBackdrop, confirmModalContent);
            
            // Show loading
            setTimeout(function() {
                loadingOverlay.classList.remove('hidden');
                
                // Submit form using AJAX
                const formData = new FormData(form);
                
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Hide loading
                    loadingOverlay.classList.add('hidden');
                    
                    if (data.success) {
                        // Show success modal
                        showModal(successModal, successBackdrop, successModalContent);
                    } else {
                        // If errors, reload page to show validation errors
                        window.location.reload();
                    }
                })
                .catch(error => {
                    // Hide loading
                    loadingOverlay.classList.add('hidden');
                    
                    // Fallback: submit normally if AJAX fails
                    form.submit();
                });
            }, 300);
        });

        // Success Button - Redirect to Login
        successBtn.addEventListener('click', function() {
            window.location.href = "{{ route('login') }}";
        });

        // Close modals on backdrop click
        confirmBackdrop.addEventListener('click', function() {
            hideModal(confirmModal, confirmBackdrop, confirmModalContent);
        });

        mismatchBackdrop.addEventListener('click', function() {
            hideModal(mismatchModal, mismatchBackdrop, mismatchModalContent);
        });

        // Modal Functions
        function showModal(modal, backdrop, content) {
            modal.classList.remove('hidden');
            setTimeout(function() {
                backdrop.style.opacity = '1';
                content.style.transform = 'scale(1)';
                content.style.opacity = '1';
            }, 10);
        }

        function hideModal(modal, backdrop, content) {
            backdrop.style.opacity = '0';
            content.style.transform = 'scale(0.95)';
            content.style.opacity = '0';
            setTimeout(function() {
                modal.classList.add('hidden');
            }, 300);
        }

        // Initialize modal styles
        confirmModalContent.style.transform = 'scale(0.95)';
        confirmModalContent.style.opacity = '0';
        confirmBackdrop.style.opacity = '0';
        
        mismatchModalContent.style.transform = 'scale(0.95)';
        mismatchModalContent.style.opacity = '0';
        mismatchBackdrop.style.opacity = '0';
        
        successModalContent.style.transform = 'scale(0.95)';
        successModalContent.style.opacity = '0';
        successBackdrop.style.opacity = '0';
    });
</script>

<style>
    #confirmModalContent,
    #mismatchModalContent,
    #successModalContent {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), 
                    opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    #confirmBackdrop,
    #mismatchBackdrop,
    #successBackdrop {
        transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endsection