<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Validation\ValidationException;
use App\Models\CategoryUserColor;
use App\Models\User;

class UserController extends Controller
{
    public function __construct() {
        $this -> middleware("guest", ["only" => [
            "index",
            "create",
            "store",
            "show"
        ]]);

        $this -> middleware("auth", ["only" => [
            "edit",
            "update",
            "destroy"
        ]]);
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
            "password" => ["required", "string", "confirmed", "max:255"]
        ]);

        $user = User::create([
            "name" => $request -> name,
            "email" => $request -> email,
            "password" => bcrypt($request -> password)
        ]);

        // Auth::login($user);

        CategoryUserColor::factory() -> create(["category_id" => 1, "user_id" => $user -> id, "color" => "#f0e600"]);
        CategoryUserColor::factory() -> create(["category_id" => 2, "user_id" => $user -> id, "color" => "#78ff78"]);
        CategoryUserColor::factory() -> create(["category_id" => 3, "user_id" => $user -> id, "color" => "#6496ff"]);
        CategoryUserColor::factory() -> create(["category_id" => 4, "user_id" => $user -> id, "color" => "#ff6464"]);

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
            "password" => ["required", "string", "max:255"]
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
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Authenticatable $user)
    {
        $categories = DB::table("category_user_colors") -> leftJoin("categories", "category_user_colors.category_id", "categories.id") -> where("category_user_colors.user_id", $user -> id) -> select("categories.id", "categories.name", "category_user_colors.color") -> get();

        return view("auth.settings", ["categories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Authenticatable $user)
    {
        if (isset($request -> colors)) {
            $request -> validate([
                "1" => ["string", "max:10"],
                "2" => ["string", "max:10"],
                "3" => ["string", "max:10"],
                "4" => ["string", "max:10"]
            ]);

            for ($category = 1; $category < 5; $category++) {
                DB::table("category_user_colors") -> where("category_id", $category) -> where("user_id", $user -> id) -> update(["color" => $request -> $category]);
            }
        }

        if (isset($request -> image)) {
            $request -> validate([
                "profileImg" => ["image", "mimes:png,jpg,jpeg", "max:2048", "dimensions:min_width=128,min_height=128,max_width=2048,max_height=2048"]
            ]);

            $imageName = date("Y-m-d_H-i-s") . "_" . $user -> name . "." . $request -> file("profileImg") -> extension();
            $request -> file("profileImg") -> storeAs("public/img/users", $imageName);

            DB::table("users") -> where("id", $user -> id) -> update(["profileImg" => "./storage/img/users/" . $imageName]);
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
