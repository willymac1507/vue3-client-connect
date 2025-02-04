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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->time('monStart')->nullable();
            $table->time('monEnd')->nullable();
            $table->time('tueStart')->nullable();
            $table->time('tueEnd')->nullable();
            $table->time('wedStart')->nullable();
            $table->time('wedEnd')->nullable();
            $table->time('thuStart')->nullable();
            $table->time('thuEnd')->nullable();
            $table->time('friStart')->nullable();
            $table->time('friEnd')->nullable();
            $table->time('satStart')->nullable();
            $table->time('satEnd')->nullable();
            $table->time('sunStart')->nullable();
            $table->time('sunEnd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
