<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\CategoryUserColor;
use App\Models\Region;
use App\Models\User;

class UserController extends Controller
{
    public function __construct() {
        $this -> middleware("auth") -> only([
            "edit",
            "update",
            "destroy",
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("auth.login");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("auth.register");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            "name" => ["required", "string", "max:25", "unique:users"],
            "email" => ["required", "string", "email", "max:50", "unique:users"],
            "password" => ["required", "string", "confirmed", "max:255"],
        ]);

        $user = User::create([
            "name" => $request -> name,
            "email" => $request -> email,
            "password" => bcrypt($request -> password),
        ]);

        $categoryUserColors = [
            [1, "#f0e600"],
            [2, "#78ff78"],
            [3, "#6496ff"],
            [4, "#ff6464"],
        ];

        foreach ($categoryUserColors as $categoryUserColor) {
            CategoryUserColor::factory() -> create([
                "category_id" => $categoryUserColor[0],
                "user_id" => $user -> id,
                "color" => $categoryUserColor[1],
            ]);
        }

        // Auth::login($user);

        return redirect() -> route("login") -> with("status", __("messages.user_registered"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $credentials = $request -> validate([
            "email" => ["required", "string", "email", "max:50"],
            "password" => ["required", "string", "max:255"],
        ]);

        if (!Auth::attempt($credentials, $request -> boolean("remember"))) {
            throw ValidationException::withMessages(["remember" => __("auth.failed")]);
        }

        $request -> session() -> regenerate();

        return redirect() -> route("index") -> with("status", __("messages.user_logged"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view("auth.settings", [
            "categories" => CategoryUserColor::leftJoin("categories", "category_user_colors.category_id", "categories.id") -> where("category_user_colors.user_id", Auth::id()) -> select("categories.id", "categories.name_" . app() -> getLocale() . " AS name", "category_user_colors.color") -> get(),
            "regions" => Region::select("id", "name_" . app() -> getLocale() . " AS name") -> get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (isset($request -> colors)) {
            $request -> validate([
                "1" => ["string", "max:10"],
                "2" => ["string", "max:10"],
                "3" => ["string", "max:10"],
                "4" => ["string", "max:10"],
            ]);

            for ($category = 1; $category < 5; $category++) {
                CategoryUserColor::where("category_id", $category) -> where("user_id", Auth::id()) -> update(["color" => $request -> $category]);
            }
        }

        if (isset($request -> image)) {
            $request -> validate([
                "profileImg" => ["image", "mimes:png,jpg,jpeg", "max:2048", "dimensions:min_width=128,min_height=128,max_width=2048,max_height=2048"],
            ]);

            $imageName = date("Y-m-d_H-i-s") . "_" . Auth::user() -> name . "." . $request -> file("profileImg") -> extension();
            $request -> file("profileImg") -> storeAs("public/img/users", $imageName);

            User::where("id", Auth::id()) -> update(["profileImg" => "./storage/img/users/" . $imageName]);
        }

        if (isset($request -> time)) {
            $request -> validate([
                "timezone" => ["string", "max:30"],
            ]);

            User::where("id", Auth::id()) -> update(["timezone" => $request -> timezone]);
        }

        return redirect() -> route("settings") -> with("status", __("messages.user_settings_updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::guard("web") -> logout();

        $request -> session() -> invalidate();
        $request -> session() -> regenerateToken();

        return redirect() -> route("index") -> with("status", __("messages.user_logged_out"));
    }
}
