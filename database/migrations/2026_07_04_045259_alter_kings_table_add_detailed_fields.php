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
        Schema::table('kings', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('spouse')->nullable();
            $table->string('birth_year')->nullable();
            $table->string('death_year')->nullable();
            $table->string('successor')->nullable();
            $table->string('predecessor')->nullable();
            $table->text('summary')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->string('status')->default('draft');
            $table->boolean('featured')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kings', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'father',
                'mother',
                'spouse',
                'birth_year',
                'death_year',
                'successor',
                'predecessor',
                'summary',
                'image',
                'gallery',
                'status',
                'featured',
            ]);
        });
    }
};
