<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('api', function (Blueprint $table) {
            $table->string('users_username')->unique()->primary();
            $table->string('key')->unique();
            $table->integer('hit_available');

            $table->foreign('users_username')->on('users')->references('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api');
    }
};
