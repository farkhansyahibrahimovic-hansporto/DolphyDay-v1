@extends('layouts.app')

@section('title', 'Create Growth Log')

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
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">New Growth Log</h1>
        <p class="text-sm sm:text-base text-gray-600 mt-1">Reflect on your journey and growth</p>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-5 sm:px-6 py-4">
            <h2 class="text-base sm:text-lg font-semibold text-white">Reflection Details</h2>
            <p class="text-blue-100 text-xs sm:text-sm mt-1">Share your thoughts and feelings</p>
        </div>

        <div class="p-5 sm:p-6">
            <!-- Error Alert -->
            @if($errors->any())
                <div class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-lg shadow-md overflow-hidden animate-shake">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-sm font-semibold text-red-800">Oops! There were some errors</h3>
                                <ul class="mt-2 text-sm text-red-700 space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 mr-1.5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>{{ $error }}</span>
                                        </li>
                                    @endforeach
                                </ul>
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

            <form method="POST" action="{{ route('growth.store') }}" class="space-y-5 sm:space-y-6">
                @csrf
                
                <!-- Mood Selection -->
                <div>
                    <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-3">
                        How are you feeling? <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-2 sm:gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="mood" value="peaceful" class="sr-only peer" required>
                            <div class="text-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:border-gray-300 transition-all">
                                <div class="text-2xl sm:text-3xl mb-1 sm:mb-2">😌</div>
                                <div class="text-xs sm:text-sm font-medium text-gray-700">Peaceful</div>
                            </div>
                        </label>
                        
                        <label class="cursor-pointer">
                            <input type="radio" name="mood" value="hopeful" class="sr-only peer">
                            <div class="text-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:border-gray-300 transition-all">
                                <div class="text-2xl sm:text-3xl mb-1 sm:mb-2">🌱</div>
                                <div class="text-xs sm:text-sm font-medium text-gray-700">Hopeful</div>
                            </div>
                        </label>
                        
                        <label class="cursor-pointer">
                            <input type="radio" name="mood" value="content" class="sr-only peer">
                            <div class="text-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:border-gray-300 transition-all">
                                <div class="text-2xl sm:text-3xl mb-1 sm:mb-2">😊</div>
                                <div class="text-xs sm:text-sm font-medium text-gray-700">Content</div>
                            </div>
                        </label>
                        
                        <label class="cursor-pointer">
                            <input type="radio" name="mood" value="growing" class="sr-only peer">
                            <div class="text-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:border-gray-300 transition-all">
                                <div class="text-2xl sm:text-3xl mb-1 sm:mb-2">🌟</div>
                                <div class="text-xs sm:text-sm font-medium text-gray-700">Growing</div>
                            </div>
                        </label>
                        
                        <label class="cursor-pointer sm:col-span-3 md:col-span-1">
                            <input type="radio" name="mood" value="struggling" class="sr-only peer">
                            <div class="text-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:border-gray-300 transition-all">
                                <div class="text-2xl sm:text-3xl mb-1 sm:mb-2">💭</div>
                                <div class="text-xs sm:text-sm font-medium text-gray-700">Struggling</div>
                            </div>
                        </label>
                    </div>
                </div>
                
                <!-- Reflection -->
                <div>
                    <label for="reflection" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">
                        Reflection <span class="text-gray-500 text-xs">(Optional)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-2.5 sm:top-3 left-3 pointer-events-none">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <textarea 
                            name="reflection" 
                            id="reflection" 
                            rows="6"
                            class="w-full pl-9 sm:pl-10 pr-4 py-2.5 sm:py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none text-sm sm:text-base"
                            placeholder="Take a moment to reflect on your day, your feelings, or your growth..."
                        >{{ old('reflection') }}</textarea>
                    </div>
                </div>
                
                <!-- Date -->
                <div>
                    <label for="log_date" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">
                        Date <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input 
                            type="date" 
                            name="log_date" 
                            id="log_date" 
                            value="{{ old('log_date', today()->format('Y-m-d')) }}"
                            required
                            class="w-full pl-9 sm:pl-10 pr-4 py-2.5 sm:py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm sm:text-base"
                        >
                    </div>
                </div>
                
                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button 
                        type="button"
                        onclick="handleCancel()"
                        class="flex-1 inline-flex items-center justify-center px-5 sm:px-6 py-2.5 sm:py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancel
                    </button>
                    <button 
                        type="submit"
                        class="flex-1 inline-flex items-center justify-center px-5 sm:px-6 py-2.5 sm:py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg text-sm sm:text-base"
                    >
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Log
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Cancel Confirmation Modal -->
<div id="cancelModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 animate-fade-in">
    <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl transform transition-all animate-scale-in">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-yellow-500 to-orange-500 p-5 sm:p-6 rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-xl sm:text-2xl font-bold text-white">Discard Changes?</h3>
                    <p class="text-yellow-100 text-xs sm:text-sm mt-0.5">You have unsaved changes</p>
                </div>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-5 sm:p-6">
            <div class="flex items-start gap-3 mb-6">
                <div class="flex-shrink-0 w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-gray-900 font-medium text-sm sm:text-base">Are you sure you want to leave?</p>
                    <p class="text-gray-600 text-xs sm:text-sm mt-1">Your reflection will be lost if you don't save it.</p>
                </div>
            </div>

            <!-- Modal Actions -->
            <div class="flex flex-col sm:flex-row gap-3">
                <button 
                    onclick="closeCancelModal()"
                    class="flex-1 px-4 sm:px-5 py-2.5 sm:py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors text-sm sm:text-base">
                    Stay
                </button>
                <button 
                    onclick="confirmCancel()"
                    class="flex-1 px-4 sm:px-5 py-2.5 sm:py-3 bg-orange-600 text-white font-semibold rounded-lg hover:bg-orange-700 transition-colors shadow-md hover:shadow-lg text-sm sm:text-base">
                    Yes, Discard
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let formChanged = false;
const form = document.querySelector('form');
const formInputs = form.querySelectorAll('input[type="radio"], textarea, input[type="date"]');

// Track form changes
formInputs.forEach(input => {
    if (input.type === 'radio') {
        input.addEventListener('change', () => {
            formChanged = true;
        });
    } else {
        input.addEventListener('input', () => {
            formChanged = true;
        });
    }
});

function handleCancel() {
    if (formChanged) {
        showCancelModal();
    } else {
        window.location.href = "{{ route('growth.index') }}";
    }
}

function showCancelModal() {
    const modal = document.getElementById('cancelModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeCancelModal() {
    const modal = document.getElementById('cancelModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function confirmCancel() {
    window.location.href = "{{ route('growth.index') }}";
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCancelModal();
    }
});

// Close modal when clicking outside
document.getElementById('cancelModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeCancelModal();
    }
});

// Prevent accidental navigation
window.addEventListener('beforeunload', function(e) {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// Don't prevent navigation on form submit
form.addEventListener('submit', function() {
    formChanged = false;
});
</script>

<style>
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes scale-in {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-shake {
    animation: shake 0.5s ease-in-out;
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

.animate-scale-in {
    animation: scale-in 0.3s ease-out;
}
</style>
@endsection