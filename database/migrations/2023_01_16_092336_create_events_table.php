<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("events", function (Blueprint $table) {
            $table -> id();
            $table -> foreignId("user_id") -> references("id") -> on("users");
            $table -> foreignId("category_id") -> references("id") -> on("categories");
            $table -> string("name", 50);
            $table -> string("description", 255) -> nullable();
            $table -> string("color", 10) -> nullable();
            $table -> dateTime("date");
            $table -> dateTime("remember") -> nullable();
            $table -> boolean("isRemembered") -> default(0);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("events");
    }
};
