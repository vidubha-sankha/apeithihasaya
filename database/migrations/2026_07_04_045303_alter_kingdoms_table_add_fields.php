<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kingdoms', function (Blueprint $table) {
            $table->string('period')->nullable();
            $table->string('map')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('draft');
        });
    }

    public function down(): void
    {
        Schema::table('kingdoms', function (Blueprint $table) {
            $table->dropColumn(['period', 'map', 'image', 'status']);
        });
    }
};
