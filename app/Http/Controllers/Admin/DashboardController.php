<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MicroAction;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard.
     */
    public function index()
    {
        // Total users
        $totalUsers = User::where('role', 'user')->count();
        
        // Active users (logged in last 7 days)
        $activeUsers = User::where('role', 'user')
            ->where('updated_at', '>=', now()->subDays(7))
            ->count();
        
        // Total micro actions
        $totalActions = MicroAction::count();
        
        // Completed actions
        $completedActions = MicroAction::completed()->count();
        
        // Completion rate
        $completionRate = $totalActions > 0 
            ? round(($completedActions / $totalActions) * 100, 1) 
            : 0;
        
        // Recent users
        $recentUsers = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'activeUsers',
            'totalActions',
            'completedActions',
            'completionRate',
            'recentUsers'
        ));
    }
}