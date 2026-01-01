@extends('layouts.guest')

@section('title', 'Sign In')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-8 bg-gray-50">
    <div class="w-full max-w-4xl">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="grid md:grid-cols-5 items-stretch">
                
                <!-- Lottie Animation - Left Side -->
                <div class="md:col-span-2 bg-blue-600 p-6 flex items-center justify-center relative overflow-hidden">
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 left-0 w-32 h-32 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 right-0 w-24 h-24 bg-white/5 rounded-full translate-x-1/2 translate-y-1/2"></div>
                    
                    <div class="relative z-10 w-full">
                        <div 
                            id="dolphin-animation" 
                            class="w-40 h-40 sm:w-48 sm:h-48 md:w-56 md:h-56 mx-auto"
                            role="img"
                            aria-label="Friendly dolphin animation"
                        ></div>
                        <div class="text-center mt-3">
                            <h2 class="text-white text-lg md:text-xl font-bold mb-1">Login System</h2>
                            <p class="text-blue-100 text-xs md:text-sm">Sign in to access your dashboard</p>
                        </div>
                    </div>
                </div>
                
                <!-- Login Form - Right Side -->
                <div class="md:col-span-3 p-6 sm:p-8">
                    
                    <!-- Header -->
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900 mb-1">
                            Welcome Back
                        </h1>
                        <p class="text-sm text-gray-600">
                            Please sign in to continue
                        </p>
                    </div>
                    
                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-5">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <ul class="text-sm space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        
                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none transition-colors duration-200" id="emailIcon">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    value="{{ old('email') }}"
                                    placeholder="name@example.com"
                                    required
                                    class="w-full pl-10 pr-4 py-2.5 text-sm border-2 border-gray-200 rounded-lg focus:border-blue-600 focus:ring-0 transition-all duration-200 outline-none"
                                >
                            </div>
                        </div>
                        
                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none transition-colors duration-200" id="passwordIcon">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    placeholder="••••••••"
                                    required
                                    class="w-full pl-10 pr-11 py-2.5 text-sm border-2 border-gray-200 rounded-lg focus:border-blue-600 focus:ring-0 transition-all duration-200 outline-none"
                                >
                                <button 
                                    type="button" 
                                    id="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-blue-600 focus:outline-none transition-colors duration-200"
                                >
                                    <!-- Eye Off Icon (default) -->
                                    <svg id="eyeOff" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                    <!-- Eye On Icon (hidden) -->
                                    <svg id="eyeOn" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Forgot Password -->
                        <div class="mb-5 text-right">
                            <button 
                                type="button"
                                id="forgotPasswordBtn"
                                class="text-sm text-blue-600 hover:text-blue-700 font-semibold hover:underline transition-colors duration-200"
                            >
                                Forgot password?
                            </button>
                        </div>
                        
                        <!-- Submit Button -->
                        <button 
                            type="submit"
                            class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-all duration-200 shadow-md hover:shadow-lg"
                        >
                            Sign In
                        </button>
                    </form>
                    
                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-3 bg-white text-gray-500">OR</span>
                        </div>
                    </div>
                    
                    <!-- Register Link -->
                    <p class="text-center text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:text-blue-700 hover:underline transition-colors duration-200">
                            Sign up now
                        </a>
                    </p>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div id="forgotPasswordModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 px-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="p-6">
            <!-- Icon Header -->
            <div class="flex items-center justify-center w-16 h-16 mx-auto bg-blue-50 rounded-full mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            
            <!-- Content -->
            <h3 class="text-xl font-bold text-gray-900 text-center mb-2">
                Forgot Password?
            </h3>
            <p class="text-sm text-gray-600 text-center mb-6">
                To reset your password, please contact our Customer Service or Administrator through one of the following contacts:
            </p>
            
            <!-- Email Info -->
            <div class="space-y-3 mb-6">
                <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                    <svg class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <div>
                        <p class="text-xs text-gray-500">Email</p>
                        <p class="text-sm font-semibold text-gray-900">support@dolphiday.com</p>
                    </div>
                </div>
            </div>
                
            <!-- Close Button -->
            <button 
                id="closeModal"
                class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-all duration-200"
            >
                Got It
            </button>
        </div>
    </div>
</div>

<!-- Lottie Web Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>

<script>
    let dolphinAnimation;
    
    document.addEventListener('DOMContentLoaded', function() {
        // Load animation
        const container = document.getElementById('dolphin-animation');
        if (container) {
            dolphinAnimation = lottie.loadAnimation({
                container: container,
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '/lottie/dolphin-swim.json',
                rendererSettings: {
                    preserveAspectRatio: 'xMidYMid meet',
                    progressiveLoad: true
                }
            });
            dolphinAnimation.setSpeed(1);
        }
        
        // Password Toggle Functionality
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOff = document.getElementById('eyeOff');
        const eyeOn = document.getElementById('eyeOn');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            eyeOff.classList.toggle('hidden');
            eyeOn.classList.toggle('hidden');
        });
        
        // Input Focus - Change Icon Color
        const emailInput = document.getElementById('email');
        const emailIcon = document.getElementById('emailIcon');
        const passwordIcon = document.getElementById('passwordIcon');
        
        emailInput.addEventListener('focus', function() {
            emailIcon.querySelector('svg').classList.remove('text-gray-400');
            emailIcon.querySelector('svg').classList.add('text-blue-600');
        });
        
        emailInput.addEventListener('blur', function() {
            emailIcon.querySelector('svg').classList.remove('text-blue-600');
            emailIcon.querySelector('svg').classList.add('text-gray-400');
        });
        
        passwordInput.addEventListener('focus', function() {
            passwordIcon.querySelector('svg').classList.remove('text-gray-400');
            passwordIcon.querySelector('svg').classList.add('text-blue-600');
        });
        
        passwordInput.addEventListener('blur', function() {
            passwordIcon.querySelector('svg').classList.remove('text-blue-600');
            passwordIcon.querySelector('svg').classList.add('text-gray-400');
        });
        
        // Modal Functionality
        const modal = document.getElementById('forgotPasswordModal');
        const modalContent = document.getElementById('modalContent');
        const forgotPasswordBtn = document.getElementById('forgotPasswordBtn');
        const closeModalBtn = document.getElementById('closeModal');
        
        function openModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }
        
        function closeModal() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }
        
        forgotPasswordBtn.addEventListener('click', openModal);
        closeModalBtn.addEventListener('click', closeModal);
        
        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
        
        // Animation interactions
        if (dolphinAnimation) {
            let isTyping = false;
            let typingTimeout;
            
            // Password interactions - slow down when typing
            passwordInput.addEventListener('focus', function() {
                dolphinAnimation.setSpeed(0.5);
            });
            
            passwordInput.addEventListener('blur', function() {
                if (!isTyping) {
                    dolphinAnimation.setSpeed(1);
                }
            });
            
            passwordInput.addEventListener('input', function() {
                isTyping = true;
                dolphinAnimation.setSpeed(0.3);
                
                clearTimeout(typingTimeout);
                typingTimeout = setTimeout(function() {
                    isTyping = false;
                    if (document.activeElement !== passwordInput) {
                        dolphinAnimation.setSpeed(1);
                    }
                }, 1000);
            });
            
            // Email interaction - speed up briefly
            emailInput.addEventListener('focus', function() {
                dolphinAnimation.setSpeed(1.5);
                setTimeout(function() {
                    if (document.activeElement === emailInput) {
                        dolphinAnimation.setSpeed(1);
                    }
                }, 1000);
            });
            
            // Form submit - speed up
            const form = document.getElementById('loginForm');
            form.addEventListener('submit', function(e) {
                dolphinAnimation.setSpeed(2);
            });
        }
    });
</script>

<style>
    /* Animation container */
    #dolphin-animation {
        position: relative;
    }
    
    /* Modal animation */
    #forgotPasswordModal {
        backdrop-filter: blur(4px);
    }
</style>
@endsection