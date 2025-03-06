<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;


class AuthController extends Controller
{
    public function login(): View
    {
        $title = "Login";
        return view("auth.login", compact("title"));
    }

    public function register(): View
    {
        $title = "Register";
        return view("auth.register", compact("title"));
    }

    public function doRegister(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data["password"] = Hash::make($data["password"]);

        User::create($data);

        return redirect()->route("auth.login")->with("success", "Register success, please login");
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|min:8",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

       $credentials = $request->only("email", "password");

       if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended("/");
        }

        return back()->with("authError", "Invalid credentials")->withInput();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("auth.login");
    }
}
