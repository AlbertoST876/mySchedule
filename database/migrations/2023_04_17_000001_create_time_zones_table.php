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
        Schema::create("time_zones", function(Blueprint $table) {
            $table -> string("name", 30) -> primary();
            $table -> foreignId("region_id") -> references("id") -> on("regions");
            $table -> string("city", 30);
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
        Schema::dropIfExists("time_zones");
    }
};
