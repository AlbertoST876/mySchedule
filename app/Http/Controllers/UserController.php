<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Validator;
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

        return redirect() -> intended("login") -> with("status", "Te has registrado correctamente");
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
            throw ValidationException::withMessages(["error" => "Las credenciales introducidas no son correctas"]);
        }

        $request -> session() -> regenerate();

        return redirect() -> intended() -> with("status", "Has iniciado sesión");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Authenticatable $user)
    {
        $categories = DB::select("SELECT categories.id, categories.name, category_user_colors.color FROM category_user_colors LEFT JOIN categories ON category_user_colors.category_id = categories.id WHERE category_user_colors.user_id = ?", [$user -> id]);

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
            $validator = Validator::make($request -> all(), [
                "1" => ["string", "max:10"],
                "2" => ["string", "max:10"],
                "3" => ["string", "max:10"],
                "4" => ["string", "max:10"]
            ]);

            if ($validator -> fails()) {
                throw ValidationException::withMessages(["errorColors" => "Los datos introducidos no son validos"]);
            }

            for ($category = 1; $category < 5; $category++) {
                DB::update("UPDATE category_user_colors SET color = ? WHERE category_id = ? AND user_id = ?", [$request -> $category, $category, $user -> id]);
            }
        }

        if (isset($request -> image)) {
            $validator = Validator::make($request -> all(), [
                "profileImg" => ["image", "mimes:jpg,jpeg,png", "max:2048", "dimensions:min_width=128,min_height=128,max_width=1024,max_height=1024"]
            ]);

            if ($validator -> fails()) {
                throw ValidationException::withMessages(["errorProfileImg" => "La imagen introducida no cumple los requisitos establecidos"]);
            }

            $imageName = date("Y-m-d_H-i-s") . "_" . $user -> name . "." . $request -> file("profileImg") -> extension();
            $request -> file("profileImg") -> storeAs("public/img/users", $imageName);

            DB::update("UPDATE users SET profileImg = ? WHERE id = ?", ["./storage/img/users/" . $imageName, $user -> id]);
        }

        return redirect() -> intended("settings") -> with("status", "Ajustes guardados correctamente");
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

        return redirect() -> intended() -> with("status", "Has cerrado sesión");
    }
}
