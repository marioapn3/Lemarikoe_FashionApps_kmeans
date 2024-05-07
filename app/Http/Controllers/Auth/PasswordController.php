<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPasswordPost(Request $request)
    {
        $customeMessage = [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email tidak terdaftar',
        ];

        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], $customeMessage);

        $token = bin2hex(random_bytes(32));

        PasswordResetToken::updateOrCreate(
            [
                'email' => $request->email,
            ],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]
        );

        // Code to send email
        Mail::to($request->email)->send(new ResetPasswordMail($token));

        // Code to send email
        return redirect()->back()->with('success', 'Email sent successfully');
    }

    public function validasiForgotPassword(Request $request, $token)
    {
        $token = PasswordResetToken::where('token', $token)->first();
        if (!$token) {
            return redirect()->route('forgot-password')->with('error', 'Token tidak valid');
        }
        return view('auth.reset-password', $token);
    }

    public function validasiForgotPasswordPost(Request $request)
    {
        $customeMessage = [
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama',
        ];

        $request->validate([
            'password' => ['required', 'min:8',],
            'password_confirmation' => ['required', 'same:password'],
            'token' => 'required',
        ], $customeMessage);
        $token = PasswordResetToken::where('token', $request->token)->first();
        $email = PasswordResetToken::where('token', $request->token)->first()->email;
        if (!$token) {
            return redirect()->route('forgot-password')->with('error', 'Token tidak valid');
        }
        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('forgot-password')->with('error', 'Email tidak terdaftar');
        }
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        $token->delete();
        return redirect()->route('login')->with('success', 'Password berhasil direset');
    }
}
