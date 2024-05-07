<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ClusteringController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionareController extends Controller
{
    private $clusterController;

    public function __construct()
    {

        $this->clusterController = new ClusteringController();
    }
    public function index()
    {
        $user = User::find(Auth::id());
        if ($user->style_preference != null) {
            return redirect()->route('dashboard.index');
        }
        return view('auth.questionare');
    }

    public function update(Request $request)
    {
        // ambil fungsi dari ClusteringController

        $user = User::find(Auth::id());
        $request->validate([
            'fashion_style' => ['required'],
            'style' => ['required'],
            'color' => ['required'],
            'gender' => ['required'],
        ]);

        $array = [
            $this->getFashionStyle($request->fashion_style),
            $this->getOccasions($request->style),
            $this->getColors($request->color),
        ];

        // $cluster = $this->ClusteringData($array);
        $cluster = $this->clusterController->ClusteringData($array);
        $user->update([
            'style_preference' => $cluster,
            'gender' => $request->gender
        ]);
        return redirect()->route('dashboard.index');
        // $user->stylePreference = $cluster;
        // $user->save();
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
