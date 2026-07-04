<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('video_url');
            $table->text('description')->nullable();
            $table->foreignId('kingdom_id')->nullable()->constrained('kingdoms')->nullOnDelete();
            $table->foreignId('dynasty_id')->nullable()->constrained('dynasties')->nullOnDelete();
            $table->foreignId('king_id')->nullable()->constrained('kings')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
