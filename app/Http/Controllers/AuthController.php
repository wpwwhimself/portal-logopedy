<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    #region login
    public function login()
    {
        if (Auth::check()) return redirect(route("profile"));
        return view("auth.login");
    }

    public function processLogin(Request $rq)
    {
        $credentials = $rq->except(["_token"]);

        if(Auth::attempt($credentials, $rq->has("remember_token"))) {
            $rq->session()->regenerate();
            return redirect()->intended(route("profile"))->with("success", "Zalogowano");
        }

        return back()->with("error", "Nieprawidłowe dane logowania");
    }
    #endregion

    #region register
    public function register()
    {
        if (Auth::check()) return redirect(route("profile"));

        return view("auth.register");
    }

    public function processRegister(Request $rq)
    {
        $validator = Validator::make($rq->all(), [
            'name' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'phone' => ['required'],
        ]);
        if ($validator->fails()) return view("auth.register")->with("error", "Coś poszło nie tak z Twoimi danymi");

        $user = User::create([
            "name" => $rq->name,
            "email" => $rq->email,
            "phone" => $rq->phone,
            "password" => Hash::make($rq->password),
        ]);

        Auth::login($user);

        return redirect(route("profile"))->with("success", "Konto zostało utworzone");
    }
    #endregion

    #region misc
    public function changePassword()
    {
        return view("auth.change-password");
    }

    public function processChangePassword(Request $rq)
    {
        $validator = Validator::make($rq->all(), [
            'password' => ['required', 'confirmed'],
        ]);
        if ($validator->fails()) return view("auth.change-password")->with("error", "Coś jest nie tak z hasłem");

        User::findOrFail(Auth::id())->update([
            "password" => Hash::make($rq->password),
        ]);
        return redirect(route("profile"))->with("success", "Hasło zostało zmienione");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/")->with("success", "Wylogowano");
    }
    #endregion
}
