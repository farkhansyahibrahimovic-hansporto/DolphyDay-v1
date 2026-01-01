<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MicroAction;
use Illuminate\Http\Request;

class MicroActionController extends Controller
{
    /**
     * Display a listing of micro actions.
     */
    public function index(Request $request)
    {
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        $filter = $request->get('filter', 'all');
        
        $query = MicroAction::where('user_id', $user->id)
            ->orderBy('action_date', 'desc');
        
        // Apply filters
        if ($filter === 'today') {
            $query->today();
        } elseif ($filter === 'week') {
            $query->thisWeek();
        } elseif ($filter === 'completed') {
            $query->completed();
        } elseif ($filter === 'pending') {
            $query->pending();
        }
        
        $actions = $query->paginate(10);
        
        return view('user.micro-actions.index', compact('actions', 'filter'));
    }
    
    /**
     * Show the form for creating a new micro action.
     */
    public function create()
    {
        return view('user.micro-actions.create');
    }
    
    /**
     * Store a newly created micro action.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'action_date' => 'required|date',
        ]);
        
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        MicroAction::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'action_date' => $request->action_date,
        ]);
        
        return redirect()->route('micro-actions.index')
            ->with('success', 'Micro action created successfully!');
    }
    
    /**
     * Show the form for editing the specified micro action.
     */
    public function edit($id)
    {
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        $action = MicroAction::where('user_id', $user->id)
            ->findOrFail($id);
        
        return view('user.micro-actions.edit', compact('action'));
    }
    
    /**
     * Update the specified micro action.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'action_date' => 'required|date',
        ]);
        
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        $action = MicroAction::where('user_id', $user->id)
            ->findOrFail($id);
        
        $action->update([
            'title' => $request->title,
            'description' => $request->description,
            'action_date' => $request->action_date,
        ]);
        
        return redirect()->route('micro-actions.index')
            ->with('success', 'Micro action updated successfully!');
    }
    
    /**
     * Mark micro action as complete/incomplete.
     */
    public function complete($id)
    {
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        $action = MicroAction::where('user_id', $user->id)
            ->findOrFail($id);
        
        if ($action->is_completed) {
            $action->markAsPending();
            $message = 'Marked as pending.';
        } else {
            $action->markAsComplete();
            $message = 'Marked as complete!';
        }
        
        return back()->with('success', $message);
    }
    
    /**
     * Remove the specified micro action.
     */
    public function destroy($id)
    {
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        $action = MicroAction::where('user_id', $user->id)
            ->findOrFail($id);
        
        $action->delete();
        
        return back()->with('success', 'Micro action deleted.');
    }
}