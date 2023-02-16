<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this -> middleware("guest", ["only" => ["login", "register"]]);
        $this -> middleware("auth", ["only" => "logout"]);
    }

    public function login(Request $request) {
        $credentials = $request -> validate([
            "email" => ["required", "string", "email", "max:50"],
            "password" => ["required", "string", "max:255"]
        ]);

        if (!Auth::attempt($credentials, $request -> boolean("remember"))) {
            throw ValidationException::withMessages(["email" => "Las credenciales introducidas no son correctas"]);
        }

        $request -> session() -> regenerate();

        return redirect() -> intended() -> with("status", "Has iniciado sesión");
    }

    public function register(Request $request) {
        $validator = Validator::make($request -> all(), [
            "name" => ["required", "string", "max:25", "unique:users"],
            "email" => ["required", "string", "email", "max:50", "unique:users"],
            "password" => ["required", "string", "confirmed", "max:255"]
        ]);

        if ($validator -> fails()) {
            $errors = $validator -> errors();

            if ($errors -> has("name")) $error = ["name" => "Ya existe un usuario con ese nombre"];
            if ($errors -> has("email")) $error = ["email" => "Ya existe un usuario con ese email"];
            if ($errors -> has("password")) $error = ["password" => "La contraseña no cumple los requisitos establecidos"];

            throw ValidationException::withMessages($error);
        }

        /* $user = */ User::create([
            "name" => $request -> name,
            "email" => $request -> email,
            "password" => bcrypt($request -> password)
        ]);

        // Auth::login($user);

        return redirect() -> intended("login") -> with("status", "Te has registrado correctamente");
    }

    public function logout(Request $request) {
        Auth::guard("web") -> logout();

        $request -> session() -> invalidate();
        $request -> session() -> regenerateToken();

        return redirect() -> intended() -> with("status", "Has cerrado sesión");
    }
}
