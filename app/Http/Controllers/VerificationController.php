<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array {
        return [
            new Middleware("auth"),
            new Middleware("signed", only: ["verify"]),
        ];
    }

    /**
     * Notify the user by email that they need to be verified.
     */
    public function notice() {
        return redirect() -> route("index") -> with("status", __("app.you_must_verified"));
    }

    /**
     * Verify the user with the credentials sent by email.
     */
    public function verify(EmailVerificationRequest $request) {
        $request -> fulfill();

        return redirect() -> route("index") -> with("status", __("app.verified"));
    }
}
