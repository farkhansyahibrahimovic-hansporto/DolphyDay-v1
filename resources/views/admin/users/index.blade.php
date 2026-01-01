@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Users Management</h1>
                <p class="text-gray-600 mt-1">Manage and monitor all registered users</p>
            </div>
            <a href="{{ route('admin.users.create') }}" 
               class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Create New User
            </a>
        </div>
    </div>

    <!-- Search & Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Search -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-3">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $search }}"
                        placeholder="Search by name or email..."
                        class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                </div>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg">
                    Search
                </button>
                @if($search)
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <!-- Total Users Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium mb-1">Total Users</p>
                    <p class="text-4xl font-bold">{{ $users->total() }}</p>
                </div>
                <div class="p-3 bg-white/20 rounded-lg backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            User
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Joined Date
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Actions Count
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Manage
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $singleUser)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-11 w-11">
                                        <img class="h-11 w-11 rounded-full ring-2 ring-gray-200" 
                                             src="{{ $singleUser->getAvatarUrl() }}" 
                                             alt="{{ $singleUser->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $singleUser->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">{{ $singleUser->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ $singleUser->created_at->format('M d, Y') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $singleUser->created_at->diffForHumans() }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    {{ $singleUser->microActions()->count() }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center gap-2">
                                    <!-- View Details -->
                                    <a href="{{ route('admin.users.show', $singleUser->id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors font-medium"
                                       title="View Details">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.users.edit', $singleUser->id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors font-medium"
                                       title="Edit User">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>

                                    <!-- Delete -->
                                    <button onclick="confirmDelete({{ $singleUser->id }})" 
                                            class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors font-medium"
                                            title="Delete User">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete
                                    </button>
                                </div>

                                <!-- Hidden Delete Form -->
                                <form id="delete-form-{{ $singleUser->id }}" 
                                      action="{{ route('admin.users.destroy', $singleUser->id) }}" 
                                      method="POST" 
                                      class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="text-gray-500 text-sm font-medium">No users found</p>
                                    @if($search)
                                        <p class="text-gray-400 text-xs mt-1">Try adjusting your search criteria</p>
                                    @else
                                        <p class="text-gray-400 text-xs mt-1">Users will appear here once they register</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm transition-opacity duration-300" 
         id="deleteBackdrop"></div>
    
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div id="deleteModalContent" 
             class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300">
            <div class="p-6">
                <!-- Icon -->
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                
                <!-- Content -->
                <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Delete User</h3>
                <p class="text-sm text-gray-600 text-center mb-6">
                    Are you sure you want to delete this user? This action cannot be undone and will remove all associated data.
                </p>
                
                <!-- Buttons -->
                <div class="flex gap-3">
                    <button type="button" 
                            id="cancelDeleteBtn"
                            class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-all">
                        Cancel
                    </button>
                    <button type="button" 
                            id="confirmDeleteBtn"
                            class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-all shadow-md hover:shadow-lg">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #deleteModalContent {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), 
                    opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    #deleteBackdrop {
        transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>

<script>
    let deleteUserId = null;

    function confirmDelete(userId) {
        deleteUserId = userId;
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
            deleteUserId = null;
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const cancelBtn = document.getElementById('cancelDeleteBtn');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        const backdrop = document.getElementById('deleteBackdrop');
        const content = document.getElementById('deleteModalContent');

        // Initialize modal styles
        content.style.transform = 'scale(0.95)';
        content.style.opacity = '0';
        backdrop.style.opacity = '0';

        // Cancel button
        cancelBtn.addEventListener('click', hideModal);

        // Backdrop click
        backdrop.addEventListener('click', hideModal);

        // Confirm delete
        confirmBtn.addEventListener('click', function() {
            if (deleteUserId) {
                document.getElementById('delete-form-' + deleteUserId).submit();
            }
        });
    });
</script>
@endsection