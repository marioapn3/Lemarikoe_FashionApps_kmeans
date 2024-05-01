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

        $top = DigitalWardrobe::where('category', 'Tops')->where('occasion', $request->ocassion)->where('style_preference', Auth::user()->style_preference)->take(3)->get();
        $bottom = DigitalWardrobe::where('category', 'Bottoms')->where('occasion', $request->ocassion)->where('style_preference', Auth::user()->style_preference)->take(3)->get();
        if ($top->isEmpty()) {
            $top = DigitalWardrobe::where('category', 'Tops')->where('occasion', $request->ocassion)->take(3)->get();
            if ($top->isEmpty()) {
                $top = DigitalWardrobe::where('category', 'Tops')->take(3)->get();
            }
        }

        if ($bottom->isEmpty()) {
            $bottom = DigitalWardrobe::where('category', 'Bottoms')->where('occasion', $request->ocassion)->take(3)->get();
            if ($bottom->isEmpty()) {
                $bottom = DigitalWardrobe::where('category', 'Bottoms')->take(3)->get();
            }
        }
        $top = DigitalWardrobe::where('category', 'Tops')->take(3)->get();
        $bottom = DigitalWardrobe::where('category', 'Bottoms')->take(3)->get();

        // $combinedData = array_merge($top->toArray(), $bottom->toArray());
        // return response()->json([
        //     'data' => $combinedData
        // ]);
        return view('dashboard.dashboard-auto-mix-match', compact('top', 'bottom'));
        // return view('dashboard.dashboard-auto-mix-match', compact('top', 'bottom'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'topImageUrl' => 'required',
                'bottomImageUrl' => 'required',
                'tags' => 'required'
            ]);

            $outfitHistory = OutfitHistory::create([
                'user_id' => Auth::id(),
                'outfit_tags' => $request->tags,
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
// <script>
//         document.addEventListener("DOMContentLoaded", function() {
//             var saveButton = document.querySelector("#saveButton");
//             if (saveButton) {
//                 saveButton.addEventListener("click", function() {
//                     var topCarouselActiveItem = document.querySelector(
//                         "#topCarousel .carousel-item.active img");
//                     var bottomCarouselActiveItem = document.querySelector(
//                         "#bottomCarousel .carousel-item.active img");
//                     var topImageUrl = topCarouselActiveItem.getAttribute("src");
//                     var bottomImageUrl = bottomCarouselActiveItem.getAttribute("src");
//                     var tagsTextarea = document.querySelector("#tags");
//                     var tags = tagsTextarea.value;

//                     // Kirim data ke backend menggunakan AJAX
//                     $.ajax({
//                         url: "/save-outfit",
//                         method: "POST",
//                         data: {
//                             topImageUrl: topImageUrl,
//                             bottomImageUrl: bottomImageUrl,
//                             tags: tags
//                         },
//                         success: function(response) {
//                             // Handle response dari backend jika diperlukan
//                             console.log(response);
//                         },
//                         error: function(xhr, status, error) {
//                             // Handle error jika terjadi
//                             console.error(xhr.responseText);
//                         }
//                     });
//                 });
//             }
//         });
//     </script>
