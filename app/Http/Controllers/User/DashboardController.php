<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MicroAction;
use App\Models\GrowthLog;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Show user dashboard.
     */
    public function index()
    {
        Log::info('📊 DASHBOARD CONTROLLER');
        
        $user = user();

        Log::info('📊 User retrieved', ['user_id' => $user->id]);

        // Get today's micro actions
        $todayActions = MicroAction::where('user_id', $user->id)
            ->today()
            ->orderBy('created_at', 'desc')
            ->get();

        // Get recent growth logs
        $recentLogs = GrowthLog::where('user_id', $user->id)
            ->orderBy('log_date', 'desc')
            ->take(3)
            ->get();

        // Calculate weekly stats
        $weeklyCompleted = MicroAction::where('user_id', $user->id)
            ->completed()
            ->whereBetween(
                'completed_at',
                [now()->startOfWeek(), now()->endOfWeek()]
            )
            ->count();

        $weeklyTotal = MicroAction::where('user_id', $user->id)
            ->thisWeek()
            ->count();

        Log::info('📊 Returning view');

        return view('user.dashboard', compact(
            'todayActions',
            'recentLogs',
            'weeklyCompleted',
            'weeklyTotal'
        ));
    }
}