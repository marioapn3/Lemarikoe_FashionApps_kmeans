<?php

namespace App\Http\Controllers;

use App\Models\DigitalWardrobe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DigitalWardrobeController extends Controller
{
    public function index()
    {
        $tops = DigitalWardrobe::where('category', 'Tops')->get();
        $bottoms = DigitalWardrobe::where('category', 'Bottoms')->get();
        $overalls = DigitalWardrobe::where('category', 'Overalls')->get();
        return view('dashboard.dashboard-wardrobe', compact('tops', 'bottoms', 'overalls'));
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
            'wardrobeTag' => 'required',
            'cloudFilePath' => 'required'
        ]);
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

        DigitalWardrobe::create([
            'user_id' => auth()->id(),
            'category' => $request->category,
            'wardrobeTag' => $request->wardrobeTag,
            'cloudFilePath' => $data,
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
}
