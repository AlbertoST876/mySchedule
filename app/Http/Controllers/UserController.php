<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request) {
        $credentials = $request -> validate([
            "email" => ["required", "string", "email", "max:50"],
            "password" => ["required", "string", "max:255"]
        ]);

        if (!Auth::attempt($credentials, $request -> boolean("remember"))) {
            throw ValidationException::withMessages([
                "email" => "Las credenciales introducidas no son correctas"
            ]);
        }

        $request -> session() -> regenerate();

        return redirect() -> intended() -> with("status", "Has iniciado sesión");
    }

    public function store(Request $request) {
        $request -> validate([
            "name" => ["required", "string", "max:25", "unique:users"],
            "email" => ["required", "string", "email", "max:50", "unique:users"],
            "password" => ["required", "confirmed", "max:255"]
        ]);

        /* $user = */ User::create([
            "name" => $request -> name,
            "email" => $request -> email,
            "password" => bcrypt($request -> password)
        ]);

        // Auth::login($user);

        return view("auth.login");
    }

    public function destroy(Request $request) {
        Auth::guard("web") -> logout();

        $request -> session() -> invalidate();
        $request -> session() -> regenerateToken();

        return redirect() -> intended() -> with("status", "Has cerrado sesión");
    }
}
