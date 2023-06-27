<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Jenssegers\Mongodb\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function category()
    {
        return $this -> belongsTo(Category::class) -> select("name_" . app() -> getLocale() . " AS name");
    }

    public function user()
    {
        return $this -> belongsTo(User::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "category_id",
        "name",
        "description",
        "color",
        "date",
        "remember",
        "isRemembered",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "date" => "datetime",
        "remember" => "datetime",
    ];
}
