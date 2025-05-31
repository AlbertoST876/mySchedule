<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Mostrar el formulario para solicitar restablecimiento
     */
    public function request()
    {
        return view("auth.forgot-password");
    }

    /**
     * Enviar el email de restablecimiento
     */
    public function email(Request $request)
    {
        $request -> validate([
            "email" => ["required", "string", "email", "max:50"],
        ]);

        $status = Password::sendResetLink(
            ["email" => $request -> email]
        );

        return $status == Password::RESET_LINK_SENT ? back() -> with(["status" => __($status)]) : back() -> withErrors(["email" => __($status)]);
    }

    /**
     * Mostrar el formulario para nueva contraseña
     */
    public function reset(Request $request, $token)
    {
        return view("auth.reset-password", [
            "token" => $token,
            "email" => $request -> email,
        ]);
    }

    /**
     * Actualizar la contraseña
     */
    public function update(Request $request)
    {
        $request->validate([
            "token" => ["required"],
            "email" => ["required", "string", "email", "max:50"],
            "password" => ["required", "string", "confirmed", "min:8", "max:255"],
        ]);

        $status = Password::reset(
            $request -> only("email", "password", "password_confirmation", "token"),
            function ($user, $password) {
                $user -> forceFill([
                    "password" => Hash::make($password)
                ]) -> setRememberToken(Str::random(60));

                $user -> save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET ? redirect() -> route("login") -> with("status", __($status)) : back() -> withErrors(["email" => [__($status)]]);
    }
}
