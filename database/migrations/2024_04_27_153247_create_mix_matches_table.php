<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mix_matches', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('digital_wardrobes_id')->constrained('digital_wardrobes');
            $table->foreignId('outfit_history_id')->constrained('outfit_histories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mix_matches');
    }
};
