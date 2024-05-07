<?php

namespace App\Http\Controllers;

use App\Models\DigitalWardrobe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DigitalWardrobeController extends Controller
{
    private $clusterController;
    public function __construct()
    {

        $this->clusterController = new ClusteringController();
    }
    public function index()
    {
        $tops = DigitalWardrobe::where('category', 'Tops')->get();
        $bottoms = DigitalWardrobe::where('category', 'Bottoms')->get();
        $overalls = DigitalWardrobe::all();
        return view('dashboard.dashboard-wardrobe', compact('tops', 'bottoms', 'overalls'));
    }
    public function filter(Request $request)
    {

        $topsQuery = DigitalWardrobe::where('category', 'Tops');

        $bottomsQuery = DigitalWardrobe::where('category', 'Bottoms');

        $overallsQuery = DigitalWardrobe::query();

        if (!empty($request->color)) {
            $topsQuery->where('color', $request->color);
            $bottomsQuery->where('color', $request->color);
            $overallsQuery->where('color', $request->color);
        }

        if (!empty($request->style)) {
            $topsQuery->where('occasion', $request->style);
            $bottomsQuery->where('occasion', $request->style);
            $overallsQuery->where('occasion', $request->style);
        }

        if (!empty($request->fashion_style)) {
            $topsQuery->where('fashionStyle', $request->fashion_style);
            $bottomsQuery->where('fashionStyle', $request->fashion_style);
            $overallsQuery->where('fashionStyle', $request->fashion_style);
        }

        $tops = $topsQuery->get();
        $bottoms = $bottomsQuery->get();
        $overalls = $overallsQuery->get();

        return view(
            'dashboard.dashboard-wardrobe',
            compact('tops', 'bottoms', 'overalls')
        );
    }
    const STORAGE_PATHS = [
        'Tops' => 'public/uploads/tops',
        'Bottoms' => 'public/uploads/bottoms',
        'Overalls' => 'public/uploads/overalls',
    ];
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'cloudFilePath' => 'required', 'wardrobeTag' => 'required'
        ]);

        $array = [
            $this->getFashionStyle($request->fashion_style),
            $this->getOccasions($request->style),
            $this->getColors($request->color),
        ];
        // $cluster = $this->ClusteringData($array);
        $cluster = $this->clusterController->ClusteringData($array);

        $category = $request->category;
        $file = $request->file('cloudFilePath');
        $originalFilename = $file->getClientOriginalName();

        // Pastikan kategori yang diberikan adalah kategori yang valid
        if (array_key_exists($category, self::STORAGE_PATHS)) {
            $storagePath = self::STORAGE_PATHS[$category];
            $path = $file->storeAs($storagePath, $originalFilename);
            $data = 'storage/' . str_replace('public/', '', $path);
        } else {
            return redirect()->back()->with('error', 'Invalid category');
        }
        //  'color', 'occasion', 'fashionStyle'
        DigitalWardrobe::create([
            'user_id' => auth()->id(),
            'category' => $request->category,
            'cloudFilePath' => $data,
            'style_preference' => $cluster,
            'wardrobeTag' => $request->wardrobeTag,
            'color' => $request->color,
            'occasion' => $request->style,
            'fashionStyle' => $request->fashion_style
        ]);

        return Redirect::back()->with('success', 'Image uploaded successfully');
    }
    public function editData($id)
    {
        $wardrobe = DigitalWardrobe::find($id);
        return response()->json([
            'data' => $wardrobe
        ]);
    }

    public function updateData(Request $request)
    {
        $wardrobe = DigitalWardrobe::find($request->id);
        $wardrobe->category = $request->category;
        $wardrobe->wardrobeTag = $request->wardrobeTag;
        $wardrobe->save();
        return Redirect::back()->with('success', 'Data updated successfully');
    }
    public function deleteData(Request $request)
    {
        try {
            $wardrobe = DigitalWardrobe::find($request->id);
            $wardrobe->delete();
            return Redirect::back()->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Data failed to delete');
        }
    }

    public function getFashionStyle($style)
    {
        if ($style == 'Vintage') {
            return 1;
        } elseif ($style == 'Casual') {
            return 2;
        } elseif ($style == 'Streetwear') {
            return 3;
        } elseif ($style == 'Minimalistic') {
            return 4;
        } elseif ($style == 'Indie') {
            return 5;
        }
    }
    public function getOccasions($style)
    {
        if ($style == 'Casual') {
            return 1;
        } elseif ($style == 'Formal') {
            return 2;
        } elseif ($style == 'Work') {
            return 3;
        } elseif ($style == 'School') {
            return 4;
        }
    }

    public function getColors($style)
    {
        if ($style == 'Dark') {
            return 1;
        } elseif ($style == 'Colourful') {
            return 2;
        } elseif ($style == 'Pastels') {
            return 3;
        } elseif ($style == 'Bright') {
            return 4;
        } elseif ($style == 'Monochrome') {
            return 5;
        }
    }
}
