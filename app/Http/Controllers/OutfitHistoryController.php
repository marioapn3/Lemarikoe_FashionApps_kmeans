<?php

namespace App\Http\Controllers;

use App\Models\DigitalWardrobe;
use App\Models\MixMatch;
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

    public function filter(Request $request)
    {
        $histories = OutfitHistory::where('user_id', Auth::user()->id);
        if (!empty($request->occasion)) {
            $histories->where('occasion', $request->occasion);
        }
        $histories = $histories->get();
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

    public function editData(Request $request)
    {
        $id = $request->id;
        $data = OutfitHistory::find($id);
        foreach ($data->mixMatch as $index => $dt) {
            if ($index === 0) {
                $top = $dt->digitalWardrobe->cloudFilePath;
            } elseif ($index === 1) {
                $bot = $dt->digitalWardrobe->cloudFilePath;
            }
        }
        $tops = DigitalWardrobe::where('category', 'Tops')->where('cloudFilePath', '!=', $top)->get();
        $bottoms = DigitalWardrobe::where('category', 'Bottoms')->where('cloudFilePath', '!=', $bot)->get();

        $topsK = DigitalWardrobe::where('category', 'Tops')->get();
        $bottomsK = DigitalWardrobe::where('category', 'Bottoms')->get();
        $overalls = DigitalWardrobe::all();

        return view('dashboard.edit-outfit', compact('tops', 'bottoms', 'overalls', 'top', 'bot', 'data', 'topsK', 'bottomsK'));
    }

    public function updateData(Request $request)
    {
        try {
            $request->validate([
                'topImageUrl' => 'required',
                'bottomImageUrl' => 'required',
                // 'tags' => 'required'
                'id' => 'required',
                'occasion' => 'required'
            ]);
            // return response()->json([
            //     'data' => [
            //         'request' => $request->all()
            //     ]
            // ]);

            $outfitHistory = OutfitHistory::find($request->id);
            $outfitHistory->occasion = $request->occasion;
            $outfitHistory->save();
            $baseUrl = url('/') . '/';
            $pathtop = str_replace($baseUrl, '', $request->topImageUrl);
            $pathbottom = str_replace($baseUrl, '', $request->bottomImageUrl);
            $top = DigitalWardrobe::where('cloudFilePath', $pathtop)->get();
            $bottom = DigitalWardrobe::where('cloudFilePath', $pathbottom)->get();

            foreach ($top as $t) {
                $top_id = $t->id;
            }
            foreach ($bottom as $b) {
                $bot_id = $b->id;
            }
            foreach ($outfitHistory->mixMatch as $index => $dt) {
                if ($index === 0) {
                    $dt->digital_wardrobes_id = $top_id;
                    $dt->save();
                } elseif ($index === 1) {
                    $dt->digital_wardrobes_id = $bot_id;
                    $dt->save();
                }
            }

            return response()->json([
                'data' => [
                    'message' => 'Outfit saved successfully!'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
