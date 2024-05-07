<?php

namespace App\Http\Controllers;

use App\Models\DigitalWardrobe;
use App\Models\MixMatch;
use App\Models\OutfitHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// use Intervention\Image\Facades\Image;

class MixMatchController extends Controller
{
    public function index()
    {
        $tops = DigitalWardrobe::where('category', 'Tops')->get();
        $bottoms = DigitalWardrobe::where('category', 'Bottoms')->get();
        $overalls = DigitalWardrobe::where('category', 'Overalls')->get();
        return view('dashboard.dashboard-mix-match', compact('tops', 'bottoms', 'overalls'));
    }

    public function index_auto()
    {
        // $histories = OutfitHistory::where('user_id', Auth::user()->id)->get();
        return view('dashboard.dashboard-auto-mix-match');
    }
    public function generateAutoMixMatch(Request $request)
    {
        $request->validate([
            'occasion' => 'required',
        ]);
        $occasion = $request->occasion;
        // dd($ocassion);
        $top = DigitalWardrobe::where('category', 'Tops')->inRandomOrder()->where('occasion', $occasion)->where('style_preference', Auth::user()->style_preference)->take(3)->get();
        $bottom = DigitalWardrobe::where('category', 'Bottoms')->inRandomOrder()->where('occasion', $occasion)->where('style_preference', Auth::user()->style_preference)->take(3)->get();
        if ($top->isEmpty()) {
            $top = DigitalWardrobe::where('category', 'Tops')->inRandomOrder()->where('occasion', $occasion)->take(3)->get();
            if ($top->isEmpty()) {
                $top = DigitalWardrobe::where('category', 'Tops')->inRandomOrder()->take(3)->get();
            }
        }

        if ($bottom->isEmpty()) {
            $bottom = DigitalWardrobe::where('category', 'Bottoms')->inRandomOrder()->where('occasion', $occasion)->take(3)->get();
            if ($bottom->isEmpty()) {
                $bottom = DigitalWardrobe::where('category', 'Bottoms')->inRandomOrder()->take(3)->get();
            }
        }
        $top = DigitalWardrobe::where('category', 'Tops')->take(3)->get();
        $bottom = DigitalWardrobe::where('category', 'Bottoms')->take(3)->get();


        return view('dashboard.dashboard-auto-mix-match', compact('top', 'bottom', 'occasion'));
        // return view('dashboard.dashboard-auto-mix-match', compact('top', 'bottom'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'topImageUrl' => 'required',
                'bottomImageUrl' => 'required',
                // 'tags' => 'required'
                'occasion' => 'required'
            ]);

            $outfitHistory = OutfitHistory::create([
                'user_id' => Auth::id(),
                'occasion' => $request->occasion,
            ]);

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
            MixMatch::create([
                'digital_wardrobes_id' => $top_id,
                'outfit_history_id' => $outfitHistory->id
            ]);

            MixMatch::create([
                'digital_wardrobes_id' => $bot_id,
                'outfit_history_id' => $outfitHistory->id
            ]);


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
