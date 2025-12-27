<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DashboardsController extends Controller
{
    public function index()
    {
        // 1. Basic Stats
        $totalNotes = Note::count();
        $totalUsers = User::count();
        $user = Auth::user();
        $myNotesCount = Note::where('user_id',$user->id)->with('images')->count();

        // 2. Data for the Pie Chart (Notes per Category)
        // This query counts how many notes are in each category
        $notesByCategory = Category::withCount('notes')
            ->having('notes_count', '>', 0) // Optional: Hide empty categories
            ->get();

        // Prepare arrays for Chart.js
        $categoryNames = $notesByCategory->pluck('name');
        $categoryCounts = $notesByCategory->pluck('notes_count');

        // 3. Recent Activity (Latest 5 notes from everyone)
        // (If you want only MY recent notes, use Auth::user()->notes())
        $recentNotes = Note::with('user', 'category')->latest()->take(5)->get();

        return view('dashboards.index', compact(
            'totalNotes', 
            'totalUsers', 
            'myNotesCount',
            'categoryNames',
            'categoryCounts',
            'recentNotes'
        ));
    }
}