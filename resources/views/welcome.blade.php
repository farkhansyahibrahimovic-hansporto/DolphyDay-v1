@extends('layouts.guest')

@section('title', 'Welcome')

@section('content')
<!-- Hero Section -->
<div class="min-h-screen flex items-center justify-center px-4 bg-gray-50">
    <div class="max-w-md w-full text-center">
        <!-- Logo & Title -->
        <h1 class="text-4xl font-bold text-gray-900 mb-4">DolphiDay</h1>
        
        <!-- Subtitle -->
        <p class="text-lg text-gray-600 mb-8">
            Your digital companion for building meaningful habits, one small step at a time.
        </p>
        
        <!-- CTA Buttons -->
        <div class="space-y-4 mb-6">
            <a href="{{ route('register') }}" 
               class="block w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-blue-700 transition">
                Get Started
            </a>
            <a href="{{ route('login') }}" 
               class="block w-full bg-white text-blue-600 py-3 px-6 rounded-lg font-medium border border-blue-600 hover:bg-blue-50 transition">
                Sign In
            </a>
        </div>

        <!-- Footer Links -->
        <div class="flex justify-center gap-4 mb-12">
            <button id="aboutBtn" 
                    class="text-sm text-gray-600 hover:text-blue-600 font-medium transition">
                About Us
            </button>
            <span class="text-gray-400">•</span>
            <button id="contactBtn" 
                    class="text-sm text-gray-600 hover:text-blue-600 font-medium transition">
                Contact Info
            </button>
        </div>
        
        <!-- Features -->
        <div class="text-sm text-gray-500 space-y-1">
            <p>Build meaningful habits</p>
            <p>Reflect on your growth</p>
            <p>No pressure, just presence</p>
        </div>
    </div>
</div>

<!-- About Us Modal -->
<div id="aboutModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm transition-opacity duration-300" 
         id="aboutBackdrop"></div>
    
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div id="aboutModalContent" 
             class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300">
            <div class="p-6">
                <!-- Icon -->
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                
                <!-- Content -->
                <h3 class="text-xl font-bold text-gray-800 text-center mb-4">
                    About DolphiDay
                </h3>
                
                <div class="text-sm text-gray-600 space-y-3 text-left">
                    <p>
                        DolphiDay is a digital platform designed to help you build and maintain 
                        positive habits in your daily life.
                    </p>
                    <p>
                        We believe that big changes start from small, consistent steps. 
                        With DolphiDay, you can track your progress, reflect on your growth, 
                        and celebrate every achievement.
                    </p>
                    <p>
                        Our mission is simple: to make personal development easy, enjoyable, 
                        and sustainable for everyone.
                    </p>
                </div>
                
                <!-- Close Button -->
                <button id="closeAboutBtn" 
                        class="w-full mt-6 px-4 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                    Got It
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Contact Modal -->
<div id="contactModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm transition-opacity duration-300" 
         id="contactBackdrop"></div>
    
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div id="contactModalContent" 
             class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300">
            <div class="p-6">
                <!-- Icon -->
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                
                <!-- Content -->
                <h3 class="text-xl font-bold text-gray-800 text-center mb-4">
                    Contact Us
                </h3>
                
                <div class="text-sm text-gray-600 space-y-4">
                    <!-- Email -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500 mb-1">Email</p>
                        <a href="mailto:support@dolphiday.com" 
                           class="text-blue-600 font-medium hover:underline">
                            support@dolphiday.com
                        </a>
                    </div>
                    
                    <!-- Guide -->
                    <div class="text-left space-y-2">
                        <p class="font-medium text-gray-700">Contact Guidelines:</p>
                        <ul class="space-y-1 text-gray-600">
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">•</span>
                                <span>Include a clear subject line</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">•</span>
                                <span>Describe your question or issue in detail</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">•</span>
                                <span>We'll respond within 1-2 business days</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Close Button -->
                <button id="closeContactBtn" 
                        class="w-full mt-6 px-4 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                    Got It
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    #aboutModalContent,
    #contactModalContent {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), 
                    opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    #aboutBackdrop,
    #contactBackdrop {
        transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal Elements
        const modals = {
            about: {
                btn: document.getElementById('aboutBtn'),
                modal: document.getElementById('aboutModal'),
                backdrop: document.getElementById('aboutBackdrop'),
                content: document.getElementById('aboutModalContent'),
                closeBtn: document.getElementById('closeAboutBtn')
            },
            contact: {
                btn: document.getElementById('contactBtn'),
                modal: document.getElementById('contactModal'),
                backdrop: document.getElementById('contactBackdrop'),
                content: document.getElementById('contactModalContent'),
                closeBtn: document.getElementById('closeContactBtn')
            }
        };

        // Initialize Modal Styles
        function initModalStyles(modal) {
            modal.content.style.transform = 'scale(0.95)';
            modal.content.style.opacity = '0';
            modal.backdrop.style.opacity = '0';
        }

        // Show Modal
        function showModal(modal) {
            modal.modal.classList.remove('hidden');
            setTimeout(() => {
                modal.backdrop.style.opacity = '1';
                modal.content.style.transform = 'scale(1)';
                modal.content.style.opacity = '1';
            }, 10);
        }

        // Hide Modal
        function hideModal(modal) {
            modal.backdrop.style.opacity = '0';
            modal.content.style.transform = 'scale(0.95)';
            modal.content.style.opacity = '0';
            setTimeout(() => {
                modal.modal.classList.add('hidden');
            }, 300);
        }

        // Setup Modal Event Listeners
        function setupModal(modal) {
            initModalStyles(modal);
            
            modal.btn.addEventListener('click', () => showModal(modal));
            modal.closeBtn.addEventListener('click', () => hideModal(modal));
            modal.backdrop.addEventListener('click', () => hideModal(modal));
        }

        // Initialize All Modals
        setupModal(modals.about);
        setupModal(modals.contact);
    });
</script>
@endsection