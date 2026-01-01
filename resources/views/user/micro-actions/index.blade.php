@extends('layouts.app')

@section('title', 'Micro Actions')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
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
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Micro Actions</h1>
            <p class="text-sm sm:text-base text-gray-600 mt-1">Manage your daily actions and habits</p>
        </div>
        <a href="{{ route('micro-actions.create') }}" 
           class="inline-flex items-center justify-center px-4 sm:px-5 py-2.5 sm:py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg text-sm sm:text-base">
            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            <span class="whitespace-nowrap">New Action</span>
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-lg p-3 sm:p-4 mb-6">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('micro-actions.index', ['filter' => 'all']) }}" 
               class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors text-sm {{ $filter === 'all' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All
            </a>
            <a href="{{ route('micro-actions.index', ['filter' => 'today']) }}" 
               class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors text-sm {{ $filter === 'today' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Today
            </a>
            <a href="{{ route('micro-actions.index', ['filter' => 'week']) }}" 
               class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors text-sm {{ $filter === 'week' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                This Week
            </a>
            <a href="{{ route('micro-actions.index', ['filter' => 'completed']) }}" 
               class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors text-sm {{ $filter === 'completed' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Completed
            </a>
            <a href="{{ route('micro-actions.index', ['filter' => 'pending']) }}" 
               class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors text-sm {{ $filter === 'pending' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Pending
            </a>
        </div>
    </div>

    <!-- Actions List -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if($actions->isEmpty())
            <div class="p-8 sm:p-12 text-center">
                <div class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 bg-blue-50 rounded-full mb-4">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <p class="text-gray-500 font-medium mb-2 text-sm sm:text-base">No actions found</p>
                <p class="text-gray-400 text-xs sm:text-sm mb-4">Start building your habits today</p>
                <a href="{{ route('micro-actions.create') }}" 
                   class="inline-flex items-center px-4 sm:px-5 py-2 sm:py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors shadow-md text-sm sm:text-base">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Create First Action
                </a>
            </div>
        @else
            <div class="divide-y divide-gray-200">
                @foreach($actions as $action)
                    <div class="p-4 sm:p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start gap-3 sm:gap-4">
                            <!-- Checkbox -->
                            <form method="POST" action="{{ route('micro-actions.complete', $action->id) }}" class="flex-shrink-0">
                                @csrf
                                <button type="submit" class="mt-0.5 sm:mt-1 group">
                                    <div class="w-6 h-6 sm:w-7 sm:h-7 border-2 rounded-lg {{ $action->is_completed ? 'bg-blue-600 border-blue-600' : 'border-gray-300 group-hover:border-blue-500' }} flex items-center justify-center transition-all">
                                        @if($action->is_completed)
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @endif
                                    </div>
                                </button>
                            </form>
                            
                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="font-semibold text-gray-900 text-sm sm:text-base {{ $action->is_completed ? 'line-through text-gray-500' : '' }}">
                                        {{ $action->title }}
                                    </h3>
                                    @if($action->is_completed)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 whitespace-nowrap">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3"/>
                                            </svg>
                                            Completed
                                        </span>
                                    @endif
                                </div>
                                @if($action->description)
                                    <p class="text-xs sm:text-sm text-gray-600 mt-1 {{ $action->is_completed ? 'line-through' : '' }}">
                                        {{ $action->description }}
                                    </p>
                                @endif
                                <div class="flex items-center gap-2 mt-2">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-xs text-gray-500">
                                        {{ $action->action_date->format('M d, Y') }}
                                    </p>
                                </div>

                                <!-- Action Buttons (Mobile: Below content) -->
                                <div class="flex flex-wrap gap-2 mt-3 sm:hidden">
                                    <a href="{{ route('micro-actions.edit', $action->id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors font-medium text-xs">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('micro-actions.destroy', $action->id) }}" 
                                          class="inline-block delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                onclick="showDeleteModal(this.closest('form'))"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors font-medium text-xs">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Action Buttons (Desktop: Right side) -->
                            <div class="hidden sm:flex items-center gap-2 flex-shrink-0">
                                <a href="{{ route('micro-actions.edit', $action->id) }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors font-medium text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('micro-actions.destroy', $action->id) }}" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                            onclick="showDeleteModal(this.closest('form'))"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors font-medium text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($actions->hasPages())
                <div class="px-4 sm:px-6 py-4 border-t border-gray-200">
                    {{ $actions->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 animate-fade-in">
    <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl transform transition-all animate-scale-in">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 p-5 sm:p-6 rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-xl sm:text-2xl font-bold text-white">Delete Action</h3>
                    <p class="text-red-100 text-xs sm:text-sm mt-0.5">This action cannot be undone</p>
                </div>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="p-5 sm:p-6">
            <div class="flex items-start gap-3 mb-6">
                <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-gray-900 font-medium text-sm sm:text-base">Are you sure you want to delete this action?</p>
                    <p class="text-gray-600 text-xs sm:text-sm mt-1">This will permanently remove the action from your list. You won't be able to recover it.</p>
                </div>
            </div>

            <!-- Modal Actions -->
            <div class="flex flex-col sm:flex-row gap-3">
                <button 
                    onclick="closeDeleteModal()"
                    class="flex-1 px-4 sm:px-5 py-2.5 sm:py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors text-sm sm:text-base">
                    Cancel
                </button>
                <button 
                    onclick="confirmDelete()"
                    class="flex-1 px-4 sm:px-5 py-2.5 sm:py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors shadow-md hover:shadow-lg text-sm sm:text-base">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let formToDelete = null;

function showDeleteModal(form) {
    formToDelete = form;
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    formToDelete = null;
}

function confirmDelete() {
    if (formToDelete) {
        formToDelete.submit();
    }
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});

// Close modal when clicking outside
document.getElementById('deleteModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>

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

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

.animate-scale-in {
    animation: scale-in 0.3s ease-out;
}
</style>
@endsection