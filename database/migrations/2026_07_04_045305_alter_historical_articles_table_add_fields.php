<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historical_articles', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('excerpt')->nullable();
            $table->string('featured_image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('status')->default('draft');
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('historical_articles', function (Blueprint $table) {
            $table->dropForeign(['historical_articles_user_id_foreign']);
            $table->dropColumn([
                'user_id',
                'excerpt',
                'featured_image',
                'published_at',
                'status',
                'seo_title',
                'seo_description'
            ]);
        });
    }
};
