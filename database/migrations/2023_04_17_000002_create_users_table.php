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
        Schema::create("users", function(Blueprint $table) {
            $table -> id();
            $table -> string("name", 25) -> unique();
            $table -> string("email", 50) -> unique();
            $table -> timestamp("email_verified_at") -> nullable();
            $table -> string("password");
            $table -> string("profileImg") -> nullable();
            $table -> string("timezone", 30) -> default("UTC") -> references("name") -> on("timezones");
            $table -> rememberToken();
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
        Schema::dropIfExists("users");
    }
};
