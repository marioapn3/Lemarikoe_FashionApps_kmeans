<?php

namespace App\Http\Controllers;

use App\Models\OutfitHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutfitHistoryController extends Controller
{
    public function index()
    {
        $histories = OutfitHistory::where('user_id', Auth::user()->id)->get();
        return view('dashboard.dashboard-history', compact('histories'));
    }

    public function getData($id)
    {
        $data = OutfitHistory::where('id', $id)->with('mixMatch.digitalWardrobe')->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function deleteData(Request $request)
    {
        $data = OutfitHistory::find($request->id);
        $data->delete();
        return redirect()->route('dashboard.outfit-history')->with('success', 'Data deleted successfully');
    }
}
