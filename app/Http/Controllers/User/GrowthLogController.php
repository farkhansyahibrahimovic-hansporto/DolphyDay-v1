<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GrowthLog;
use Illuminate\Http\Request;

class GrowthLogController extends Controller
{
    /**
     * Display a listing of growth logs.
     */
    public function index(Request $request)
    {
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        $mood = $request->get('mood');
        
        $query = GrowthLog::where('user_id', $user->id)
            ->orderBy('log_date', 'desc');
        
        // Filter by mood if provided
        if ($mood) {
            $query->byMood($mood);
        }
        
        $logs = $query->paginate(10);
        
        return view('user.growth.index', compact('logs', 'mood'));
    }
    
    /**
     * Show the form for creating a new growth log.
     */
    public function create()
    {
        return view('user.growth.create');
    }
    
    /**
     * Store a newly created growth log.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reflection' => 'nullable|string',
            'mood' => 'required|in:peaceful,hopeful,content,growing,struggling',
            'log_date' => 'required|date',
        ]);
        
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        GrowthLog::create([
            'user_id' => $user->id,
            'reflection' => $request->reflection,
            'mood' => $request->mood,
            'log_date' => $request->log_date,
        ]);
        
        return redirect()->route('growth.index')
            ->with('success', 'Growth log created successfully!');
    }
    
    /**
     * Display the specified growth log.
     */
    public function show($id)
    {
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        $log = GrowthLog::where('user_id', $user->id)
            ->findOrFail($id);
        
        return view('user.growth.show', compact('log'));
    }
}