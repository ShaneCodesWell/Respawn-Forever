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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('youtube_id');          // e.g. "dQw4w9WgXcQ" from the video URL
            $table->string('category');             // "Blind Playthrough", "Retrospective", "First Reaction"
            $table->string('duration')->nullable();  // "28:14" — display only, not used for logic
            $table->text('description')->nullable();
            $table->boolean('is_short')->default(false); // true = feeds the Shorts row instead of Now Playing
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
