<?php

namespace App\Http\Controllers;

use App\Models\OutfitHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $histories = OutfitHistory::where('user_id', Auth::user()->id)->get();
        return view('dashboard.index', compact('histories'));
    }
}
