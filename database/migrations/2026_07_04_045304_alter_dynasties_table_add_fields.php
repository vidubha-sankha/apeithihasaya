<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dynasties', function (Blueprint $table) {
            $table->string('origin')->nullable();
            $table->string('status')->default('draft');
        });
    }

    public function down(): void
    {
        Schema::table('dynasties', function (Blueprint $table) {
            $table->dropColumn(['origin', 'status']);
        });
    }
};
