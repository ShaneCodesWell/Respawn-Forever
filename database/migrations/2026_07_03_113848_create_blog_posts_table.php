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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // used in the URL: /blog/{slug}
            $table->text('excerpt')->nullable();   // short description for cards
            $table->longText('body');               // the full article
            $table->string('tag');                  // "Opinion", "Hot Take", "Process", etc.
            $table->string('featured_image')->nullable(); // storage path
            $table->boolean('is_featured')->default(false); // controls the big card at top of index
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
