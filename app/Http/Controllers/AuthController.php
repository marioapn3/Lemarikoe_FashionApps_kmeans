<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Phpml\Clustering\KMeans;

class AuthController extends Controller
{
    private $clusterController;
    public function __construct()
    {

        $this->clusterController = new ClusteringController();
    }
    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->back()->with('success', true);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        User::create($credentials);
        // setelh sukses login langsung
        Auth::attempt($credentials);

        return redirect()->route('dashboard.questionare');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function manage_account()
    {
        return view('auth.manage-account');
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        try {
            request()->validate([
                'current-password' => 'required',
                'password' => 'required',
            ]);
            // cek password lama dulu
            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
            }
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success', 'Password updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function questionare()
    {
        $user = User::find(Auth::id());
        if ($user->style_preference != null) {
            return redirect()->route('dashboard.index');
        }
        return view('auth.questionare');
    }

    public function questionareUpdate(Request $request)
    {
        // ambil fungsi dari ClusteringController

        $user = User::find(Auth::id());
        $request->validate([
            'fashion_style' => ['required'],
            'style' => ['required'],
            'color' => ['required'],
        ]);

        $array = [
            $this->getFashionStyle($request->fashion_style),
            $this->getOccasions($request->style),
            $this->getColors($request->color),
        ];

        // $cluster = $this->ClusteringData($array);
        $cluster = $this->clusterController->ClusteringData($array);
        $user->update([
            'style_preference' => $cluster
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
