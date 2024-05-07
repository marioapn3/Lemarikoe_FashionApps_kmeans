<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ClusteringController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{


    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        User::create($credentials);
        Auth::attempt($credentials);

        return redirect()->route('dashboard.questionare');
    }
}
